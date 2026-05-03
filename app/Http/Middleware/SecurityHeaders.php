<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and add security headers.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $viteHosts = app()->environment('local')
            ? " http://localhost:5173 http://127.0.0.1:5173 ws://localhost:5173 ws://127.0.0.1:5173"
            : "";

        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Prevent clickjacking attacks
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Disable legacy browser XSS auditors; modern protection is handled through CSP and output encoding.
        $response->headers->set('X-XSS-Protection', '0');

        // Control referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Reduce cross-origin data exposure.
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');
        $response->headers->set('X-DNS-Prefetch-Control', 'off');

        // Disable unwanted browser features
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        // Strict Transport Security (HTTPS only - enable in production)
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Content Security Policy
        $csp = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline'" . $viteHosts,
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "font-src 'self' https://fonts.gstatic.com",
            "img-src 'self' data: https://rickandmortyapi.com",
            "connect-src 'self' https://rickandmortyapi.com" . $viteHosts,
            "object-src 'none'",
            "frame-src 'none'",
            "frame-ancestors 'self'",
            "base-uri 'self'",
            "form-action 'self'",
            "manifest-src 'self'",
        ];

        if (app()->environment('production')) {
            $csp[] = 'upgrade-insecure-requests';
        }
        
        $response->headers->set('Content-Security-Policy', implode('; ', $csp));

        return $response;
    }
}
