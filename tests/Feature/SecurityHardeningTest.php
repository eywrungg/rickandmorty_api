<?php

namespace Tests\Feature;

use App\Mail\OtpMail;
use App\Models\EmailOtp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SecurityHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_security_headers_are_applied_to_public_pages(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('Cross-Origin-Opener-Policy', 'same-origin');
        $response->assertHeader('Cross-Origin-Resource-Policy', 'same-origin');
        $response->assertHeader('X-Permitted-Cross-Domain-Policies', 'none');

        $this->assertStringContainsString("object-src 'none'", $response->headers->get('Content-Security-Policy'));
        $this->assertStringContainsString('https://rickandmortyapi.com', $response->headers->get('Content-Security-Policy'));
    }

    public function test_registration_otps_are_hashed_at_rest(): void
    {
        Mail::fake();

        $email = 'secure-user@example.com';

        $this->postJson(route('send.otp'), ['email' => $email])
            ->assertOk()
            ->assertJson(['success' => true]);

        $sentOtp = null;
        Mail::assertSent(OtpMail::class, function (OtpMail $mail) use (&$sentOtp) {
            $sentOtp = $mail->otp;

            return true;
        });

        $record = EmailOtp::where('email', $email)->firstOrFail();

        $this->assertNotSame($sentOtp, $record->otp);
        $this->assertTrue(Hash::check($sentOtp, $record->otp));

        $this->post(route('register'), [
            'name' => 'Security Tester',
            'email' => $email,
            'password' => 'Secure123',
            'password_confirmation' => 'Secure123',
            'otp' => $sentOtp,
        ])->assertRedirect('/dashboard');

        $this->assertAuthenticated();
        $this->assertDatabaseMissing('email_otps', ['email' => $email]);
    }

    public function test_character_search_rejects_script_like_payloads(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('characters.index'))
            ->get(route('characters.index', ['name' => '<script>alert(1)</script>']))
            ->assertRedirect(route('characters.index'))
            ->assertSessionHasErrors('name');
    }

    public function test_episode_search_rejects_sql_injection_like_payloads(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('episodes.index'))
            ->get(route('episodes.index', ['name' => "' OR 1=1 --"]))
            ->assertRedirect(route('episodes.index'))
            ->assertSessionHasErrors('name');
    }
}
