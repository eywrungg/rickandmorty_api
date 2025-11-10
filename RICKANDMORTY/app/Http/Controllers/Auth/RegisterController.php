<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailOtp;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Mail\OtpMail;
use App\Mail\WelcomeMail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Override register() to avoid firing Laravel's Registered event
     */
    public function register(Request $request)
    {
        // Sanitize inputs before validation
        $request->merge([
            'name' => strip_tags($request->name),
            'email' => strtolower(trim($request->email)),
        ]);

        // Validate (includes otp)
        $this->validator($request->all())->validate();

        // Create user (will perform OTP check and throw validation exception if invalid)
        $user = $this->create($request->all());

        // Log the user in (without firing Registered event)
        $this->guard()->login($user);

        // Regenerate session to prevent session fixation
        $request->session()->regenerate();

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'otp'      => ['required', 'digits:6'],
        ], [
            'name.regex' => 'Name can only contain letters and spaces.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
        ]);
    }

    /**
     * Create user after OTP validation.
     */
    protected function create(array $data)
    {
        // 1) Verify OTP exists, matches, and not expired in email_otps table
        $otpRecord = EmailOtp::where('email', $data['email'])
                    ->where('otp', $data['otp'])
                    ->where('expires_at', '>', Carbon::now())
                    ->first();

        if (!$otpRecord) {
            // Throw a validation exception so the error appears on the form
            throw \Illuminate\Validation\ValidationException::withMessages([
                'otp' => ['Invalid or expired OTP. Request a new one and try again.']
            ]);
        }

        // 2) Create user and mark email_verified_at
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => Carbon::now(),
        ]);

        // 3) Delete OTP record (consumed)
        try {
            $otpRecord->delete();
        } catch (\Exception $e) {
            \Log::warning("Failed to delete OTP record for {$data['email']}: ".$e->getMessage());
        }

        // 4) Send welcome mail (best-effort, don't block registration)
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (\Exception $e) {
            \Log::error('WelcomeMail error: '.$e->getMessage());
        }

        return $user;
    }

    /**
     * AJAX endpoint to create/store OTP in email_otps and send it.
     * Protected with rate limiting to prevent abuse.
     */
    public function sendOtp(Request $request)
    {
        // Rate limiting by IP address (3 attempts per 3 minutes)
        $rateLimitKey = 'send-otp:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return response()->json([
                'success' => false, 
                'message' => "Too many OTP requests. Please try again in {$seconds} seconds."
            ], 429);
        }

        // Validate email format
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a valid email address.'
            ], 422);
        }

        $email = strtolower(trim($request->email));

        // Check if email already exists
        if (User::where('email', $email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already registered. Please login instead.'
            ], 422);
        }

        // Generate secure 6-digit OTP
        $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(10); // Increased to 10 minutes

        try {
            // Update or create OTP row with hashed OTP for security
            EmailOtp::updateOrCreate(
                ['email' => $email],
                [
                    'otp' => $otp, // Store plain for this implementation, consider hashing in production
                    'expires_at' => $expiresAt
                ]
            );
        } catch (\Exception $e) {
            \Log::error("EmailOtp DB error for {$email}: ".$e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Server error. Please try again later.'
            ], 500);
        }

        try {
            // Send OTP via email
            Mail::to($email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            \Log::error("OTP mail error to {$email}: ".$e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Failed to send OTP. Please check your email address.'
            ], 500);
        }

        // Increment rate limiter
        RateLimiter::hit($rateLimitKey, 180); // 3 minutes decay

        return response()->json([
            'success' => true, 
            'message' => 'OTP sent successfully! Check your email. Code expires in 10 minutes.'
        ]);
    }

    /**
     * Clean up expired OTPs (call this via scheduled task)
     */
    public static function cleanupExpiredOtps()
    {
        try {
            $deleted = EmailOtp::where('expires_at', '<', Carbon::now())->delete();
            \Log::info("Cleaned up {$deleted} expired OTP records");
        } catch (\Exception $e) {
            \Log::error("Failed to cleanup expired OTPs: " . $e->getMessage());
        }
    }
}