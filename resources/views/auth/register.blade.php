@extends('layouts.auth')

@section('title', 'Register')
@section('auth-card-width', 'max-w-2xl')

@section('content')
@php
    $inputClass = 'min-h-11 w-full rounded-lg border border-white/10 bg-[#0a171e]/65 px-3 text-white outline-none transition placeholder:text-slate-600 focus:border-[#97ce4c]/60 focus:ring-4 focus:ring-[#97ce4c]/10';
@endphp

<div class="space-y-4">
    <a href="{{ route('home') }}" class="inline-flex min-h-10 items-center gap-2 rounded-lg border border-white/10 bg-white/[0.04] px-3 text-sm font-bold text-slate-200 transition hover:border-[#01b4c6]/45 hover:bg-[#01b4c6]/12">
        <x-ui.icon name="arrow-left" class="h-4 w-4" />
        Back
    </a>

    <div class="text-center">
        <div>
            <h1 class="font-display text-3xl font-extrabold tracking-[-0.04em] text-white">Create account</h1>
            <p class="mt-1 text-sm leading-6 text-slate-400">Verify your email with a one-time code, then start saving favorites.</p>
        </div>
    </div>

    @if (session('status'))
        <div class="flex gap-3 rounded-lg border border-[#97ce4c]/30 bg-[#97ce4c]/12 p-3 text-sm font-semibold text-[#fff874]">
            <x-ui.icon name="beacon" class="mt-0.5 h-5 w-5 flex-none" />
            <p>{{ session('status') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="flex gap-3 rounded-lg border border-red-400/25 bg-red-500/10 p-3 text-sm font-semibold text-red-100">
            <x-ui.icon name="close" class="mt-0.5 h-5 w-5 flex-none" />
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" id="register-form" class="space-y-3">
        @csrf

        <div class="grid gap-3 lg:grid-cols-[0.8fr_1.2fr]">
            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-300" for="name">Full name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" class="{{ $inputClass }} @error('name') border-red-400/60 @enderror" required autocomplete="name">
                @error('name')
                    <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-300" for="email">Email address</label>
                <div class="grid gap-2 sm:grid-cols-[1fr_auto]">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="{{ $inputClass }} @error('email') border-red-400/60 @enderror" required autocomplete="email">
                    <button type="button" id="send-otp" class="inline-flex min-h-11 items-center justify-center rounded-lg border border-white/10 bg-white/[0.04] px-4 text-sm font-bold text-white transition hover:border-[#01b4c6]/45 hover:bg-[#01b4c6]/12">Send OTP</button>
                </div>
                @error('email')
                    <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid gap-3 sm:grid-cols-2">
            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-300" for="otp">Verification code</label>
                <input id="otp" name="otp" type="text" value="{{ old('otp') }}" maxlength="6" class="{{ $inputClass }} font-mono tracking-[0.3em] @error('otp') border-red-400/60 @enderror" required>
                @error('otp')
                    <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-300" for="password">Password</label>
                <div class="relative">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="{{ $inputClass }} pr-11 @error('password') border-red-400/60 @enderror"
                        required
                        data-password-strength="#passwordStrength"
                        data-password-strength-label="#passwordStrengthLabel"
                    >
                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md p-1 text-slate-400 transition hover:bg-white/10 hover:text-white" data-password-toggle="#password" aria-label="Show password">
                        <x-ui.icon name="beacon" class="h-5 w-5" />
                    </button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                @enderror
                <div class="mt-2 space-y-1">
                    <div id="passwordStrength" class="h-1.5 rounded-full bg-white/10 [--strength:0]" style="background: linear-gradient(90deg, #97ce4c calc(var(--strength) * 25%), rgba(255,255,255,.1) 0);"></div>
                    <p id="passwordStrengthLabel" class="text-xs text-slate-500">Password strength: none</p>
                </div>
            </div>
        </div>

        <div class="grid gap-3 sm:grid-cols-[1fr_auto] sm:items-start">
            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-300" for="password_confirmation">Confirm password</label>
                <div class="relative">
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="{{ $inputClass }} pr-11"
                        required
                        data-password-match-target="#password"
                        data-password-match-message="#passwordMatchMessage"
                    >
                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md p-1 text-slate-400 transition hover:bg-white/10 hover:text-white" data-password-toggle="#password_confirmation" aria-label="Show password">
                        <x-ui.icon name="beacon" class="h-5 w-5" />
                    </button>
                </div>
                <p id="passwordMatchMessage" class="mt-2 hidden text-xs"></p>
            </div>

            <button type="submit" class="mt-0 inline-flex min-h-11 items-center justify-center rounded-lg bg-[#97ce4c] px-6 text-base font-extrabold text-[#10212b] shadow-[0_0_30px_rgba(151,206,76,.24)] transition hover:-translate-y-0.5 hover:bg-[#fff874] sm:mt-[1.875rem]">
                Create account
            </button>
        </div>
    </form>

    <div class="border-t border-white/10 pt-4 text-center text-sm text-slate-400">
        Already have access?
        <a href="{{ route('login') }}" class="font-semibold text-[#fff874] transition hover:text-white">Login instead.</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sendOtpButton = document.getElementById('send-otp');
    const emailInput = document.getElementById('email');
    const otpInput = document.getElementById('otp');
    let cooldown = 0;
    let timer = null;

    function setButtonLabel() {
        if (!sendOtpButton) return;
        sendOtpButton.textContent = cooldown > 0 ? `Resend in ${cooldown}s` : 'Send OTP';
        sendOtpButton.disabled = cooldown > 0;
    }

    sendOtpButton?.addEventListener('click', async function () {
        const email = emailInput.value.trim();

        if (!email) {
            window.alert('Enter your email first.');
            emailInput.focus();
            return;
        }

        sendOtpButton.disabled = true;
        sendOtpButton.textContent = 'Sending...';

        try {
            const response = await fetch('{{ route('send.otp') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken,
                },
                body: JSON.stringify({ email }),
            });

            const payload = await response.json().catch(() => ({}));

            if (!response.ok || !payload.success) {
                throw new Error(payload.message ?? 'Unable to send OTP.');
            }

            window.alert(payload.message ?? 'OTP sent successfully.');
            otpInput.focus();
            cooldown = 60;
            setButtonLabel();

            timer = window.setInterval(() => {
                cooldown -= 1;
                setButtonLabel();
                if (cooldown <= 0 && timer) {
                    window.clearInterval(timer);
                    timer = null;
                }
            }, 1000);
        } catch (error) {
            console.error(error);
            window.alert(error.message ?? 'Unable to send OTP.');
            sendOtpButton.disabled = false;
            sendOtpButton.textContent = 'Send OTP';
        }
    });
});
</script>
@endsection
