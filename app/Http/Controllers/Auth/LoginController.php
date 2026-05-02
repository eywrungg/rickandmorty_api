<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Maximum login attempts before lockout
     */
    protected $maxAttempts = 5;

    /**
     * Lockout duration in minutes
     */
    protected $decayMinutes = 5;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle a login request to the application.
     * Override to add enhanced security.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Sanitize email input
        $request->merge([
            'email' => strtolower(trim($request->email))
        ]);

        // Validate input
        $this->validateLogin($request);

        // Check if user is locked out
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Attempt to log the user in
        if ($this->attemptLogin($request)) {
            // Clear rate limiter on successful login
            $this->clearLoginAttempts($request);
            
            return $this->sendLoginResponse($request);
        }

        // Increment login attempts
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ], [
            'email.email' => 'Please enter a valid email address.',
            'email.required' => 'Email address is required.',
            'password.required' => 'Password is required.',
        ]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $attempts = RateLimiter::attempts($this->throttleKey($request));
        $remaining = $this->maxAttempts - $attempts;

        $message = 'The provided credentials do not match our records.';
        
        if ($remaining <= 2 && $remaining > 0) {
            $message .= " You have {$remaining} attempt(s) remaining before lockout.";
        }

        throw ValidationException::withMessages([
            $this->username() => [$message],
        ]);
    }

    /**
     * Get the lockout response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));
        $minutes = ceil($seconds / 60);

        throw ValidationException::withMessages([
            $this->username() => ["Too many login attempts. Please try again in {$minutes} minute(s)."],
        ])->status(429);
    }

    /**
     * The user has been authenticated.
     * Override to add session regeneration for security.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Regenerate session ID to prevent session fixation attacks
        $request->session()->regenerate();
        
        // Log successful login
        \Log::info("User logged in: {$user->email} from IP: {$request->ip()}");
        
        return redirect()->route('dashboard');
    }

    /**
     * Log the user out of the application.
     * Override to add session invalidation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $email = auth()->user()->email ?? 'unknown';
        
        $this->guard()->logout();

        // Invalidate session
        $request->session()->invalidate();
        
        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Log logout
        \Log::info("User logged out: {$email} from IP: {$request->ip()}");

        return redirect('/');
    }

    /**
     * Get the throttle key for the given request.
     * Using email + IP for better security.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input($this->username())).'|'.$request->ip();
    }

    /**
     * Redirect after logout
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/');
    }
}