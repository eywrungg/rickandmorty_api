@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="space-y-6">
    <a href="{{ route('home') }}" class="inline-flex min-h-10 items-center gap-2 rounded-lg border border-white/10 bg-white/[0.04] px-3 text-sm font-bold text-slate-200 transition hover:border-[#01b4c6]/45 hover:bg-[#01b4c6]/12">
        <x-ui.icon name="arrow-left" class="h-4 w-4" />
        Back
    </a>

    <div class="text-center">
        <div>
            <h1 class="font-display text-4xl font-extrabold tracking-[-0.04em] text-white">Login</h1>
            <p class="mt-2 text-sm leading-6 text-slate-400">Use your account credentials to return to the dashboard.</p>
        </div>
    </div>

    @if (session('status'))
        <div class="flex gap-3 rounded-lg border border-[#97ce4c]/30 bg-[#97ce4c]/12 p-4 text-sm font-semibold text-[#fff874]">
            <x-ui.icon name="beacon" class="mt-0.5 h-5 w-5 flex-none" />
            <p>{{ session('status') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="flex gap-3 rounded-lg border border-red-400/25 bg-red-500/10 p-4 text-sm font-semibold text-red-100">
            <x-ui.icon name="close" class="mt-0.5 h-5 w-5 flex-none" />
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-300" for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" class="min-h-12 w-full rounded-lg border border-white/10 bg-[#0a171e]/65 px-4 text-white outline-none transition placeholder:text-slate-600 focus:border-[#97ce4c]/60 focus:ring-4 focus:ring-[#97ce4c]/10 @error('email') border-red-400/60 @enderror" required autofocus autocomplete="email">
            @error('email')
                <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="mb-2 flex items-center justify-between gap-3">
                <label class="block text-sm font-semibold text-slate-300" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-[#fff874] transition hover:text-white">Forgot password?</a>
                @endif
            </div>
            <div class="relative">
                <input id="password" name="password" type="password" class="min-h-12 w-full rounded-lg border border-white/10 bg-[#0a171e]/65 px-4 pr-12 text-white outline-none transition focus:border-[#97ce4c]/60 focus:ring-4 focus:ring-[#97ce4c]/10 @error('password') border-red-400/60 @enderror" required autocomplete="current-password">
                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md p-1 text-slate-400 transition hover:bg-white/10 hover:text-white" data-password-toggle="#password" aria-label="Show password">
                    <x-ui.icon name="beacon" class="h-5 w-5" />
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-3 text-sm text-slate-400">
            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-white/10 bg-white/5 text-[#97ce4c]">
            Remember this device
        </label>

        <button type="submit" class="inline-flex min-h-12 w-full items-center justify-center rounded-lg bg-[#97ce4c] px-6 text-base font-extrabold text-[#10212b] shadow-[0_0_30px_rgba(151,206,76,.24)] transition hover:-translate-y-0.5 hover:bg-[#fff874]">
            Login to dashboard
        </button>
    </form>

    <div class="border-t border-white/10 pt-5 text-center text-sm text-slate-400">
        Need an account?
        <a href="{{ route('register') }}" class="font-semibold text-[#fff874] transition hover:text-white">Create one here.</a>
    </div>
</div>
@endsection
