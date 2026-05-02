@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="space-y-6">
    <div class="space-y-3 text-center">
        <a href="{{ route('home') }}" class="brand-lockup justify-center">
            <span class="brand-mark">
                <x-ui.icon name="portal" class="h-5 w-5" />
            </span>
            <span>Rick & Morty Portal</span>
        </a>
        <span class="eyebrow !mx-auto">Reset link request</span>
        <h1 class="section-title">Forgot your password?</h1>
        <p class="record-subtitle">Enter your email and Laravel will send a password reset link.</p>
    </div>

    @if (session('status'))
        <div class="flash-banner success">
            <x-ui.icon name="beacon" class="mt-0.5 h-5 w-5 flex-none" />
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div>
            <label class="mb-2 block text-sm text-[var(--rm-muted)]" for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="custom-field @error('email') !border-[var(--rm-danger)] @enderror" required autocomplete="email" autofocus>
            @error('email')
                <p class="mt-2 text-sm text-[var(--rm-danger)]">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="accent-button w-full">Send reset link</button>
    </form>

    <div class="border-t border-white/8 pt-5 text-center text-sm text-[var(--rm-muted)]">
        Remembered it?
        <a href="{{ route('login') }}" class="text-[var(--rm-acid)]">Return to login.</a>
    </div>
</div>
@endsection
