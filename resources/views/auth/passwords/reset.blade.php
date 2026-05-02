@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="space-y-6">
    <div class="space-y-3 text-center">
        <a href="{{ route('home') }}" class="brand-lockup justify-center">
            <span class="brand-mark">
                <x-ui.icon name="portal" class="h-5 w-5" />
            </span>
            <span>Rick & Morty Portal</span>
        </a>
        <span class="eyebrow !mx-auto">Credential recovery</span>
        <h1 class="section-title">Choose a new password</h1>
        <p class="record-subtitle">Confirm your email and set a replacement password for the account.</p>
    </div>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label class="mb-2 block text-sm text-[var(--rm-muted)]" for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" class="custom-field @error('email') !border-[var(--rm-danger)] @enderror" required autocomplete="email" autofocus>
            @error('email')
                <p class="mt-2 text-sm text-[var(--rm-danger)]">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm text-[var(--rm-muted)]" for="password">New password</label>
            <div class="relative">
                <input id="password" type="password" name="password" class="custom-field pr-12 @error('password') !border-[var(--rm-danger)] @enderror" required autocomplete="new-password">
                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--rm-muted)]" data-password-toggle="#password">
                    <x-ui.icon name="beacon" class="h-5 w-5" />
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-[var(--rm-danger)]">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm text-[var(--rm-muted)]" for="password_confirmation">Confirm password</label>
            <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation" class="custom-field pr-12" required autocomplete="new-password">
                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--rm-muted)]" data-password-toggle="#password_confirmation">
                    <x-ui.icon name="beacon" class="h-5 w-5" />
                </button>
            </div>
        </div>

        <button type="submit" class="accent-button w-full">Reset password</button>
    </form>
</div>
@endsection
