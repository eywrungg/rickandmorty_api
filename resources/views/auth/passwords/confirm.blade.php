@extends('layouts.auth')

@section('title', 'Confirm Password')

@section('content')
<div class="space-y-6">
    <div class="space-y-3 text-center">
        <a href="{{ route('home') }}" class="brand-lockup justify-center">
            <span class="brand-mark">
                <x-ui.icon name="portal" class="h-5 w-5" />
            </span>
            <span>Rick & Morty Portal</span>
        </a>
        <span class="eyebrow !mx-auto">Protected action</span>
        <h1 class="section-title">Confirm your password</h1>
        <p class="record-subtitle">This route requires a quick password confirmation before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf
        <div>
            <label class="mb-2 block text-sm text-[var(--rm-muted)]" for="password">Password</label>
            <div class="relative">
                <input id="password" type="password" name="password" class="custom-field pr-12 @error('password') !border-[var(--rm-danger)] @enderror" required autocomplete="current-password">
                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--rm-muted)]" data-password-toggle="#password">
                    <x-ui.icon name="beacon" class="h-5 w-5" />
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-[var(--rm-danger)]">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="accent-button w-full">Confirm password</button>
    </form>

    @if (Route::has('password.request'))
        <div class="border-t border-white/8 pt-5 text-center text-sm text-[var(--rm-muted)]">
            Need a reset link?
            <a href="{{ route('password.request') }}" class="text-[var(--rm-acid)]">Request one.</a>
        </div>
    @endif
</div>
@endsection
