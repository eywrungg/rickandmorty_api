@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-br from-[#0A0E27] via-[#1a1f3a] to-[#0A0E27] relative overflow-x-hidden">
    <!-- Animated Background Particles -->
    <div class="fixed inset-0 pointer-events-none" id="particles"></div>

    <div class="max-w-lg w-full relative z-10">
        <!-- Header -->
        <div class="text-center mb-8 animate-fade-in">
            <a href="/" class="inline-block group">
                <h1 class="font-['Orbitron'] text-5xl font-black text-white glow-text mb-2 transition-transform group-hover:scale-105">
                    ⚛ R&M PORTAL
                </h1>
            </a>
            <p class="text-gray-400 text-lg">Join the interdimensional network</p>
        </div>

        <!-- Register Form -->
        <div class="glass rounded-2xl p-8 shadow-2xl transform transition-all hover:shadow-[#44FF44]/20">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white mb-1">Create Account</h2>
                <div class="h-1 w-12 bg-gradient-to-r from-[#44FF44] to-[#00B5CC] rounded-full"></div>
            </div>

            @if (session('status'))
                <div class="mb-4 p-3 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg text-red-400 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="register-form" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-gray-300 text-sm font-semibold mb-2">
                        Full Name
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus
                        autocomplete="name"
                        maxlength="255"
                        pattern="[A-Za-z\s]+"
                        class="w-full px-4 py-3 bg-white/5 border border-[#44FF44]/30 rounded-lg focus:border-[#44FF44] focus:ring-2 focus:ring-[#44FF44]/20 focus:outline-none text-white transition-all @error('name') border-red-500 @enderror"
                        placeholder="Rick Sanchez">
                    @error('name')
                        <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email + Send OTP -->
                <div>
                    <label for="email" class="block text-gray-300 text-sm font-semibold mb-2">
                        Email Address
                    </label>
                    <div class="flex gap-2">
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required
                            autocomplete="email"
                            maxlength="255"
                            class="flex-1 px-4 py-3 bg-white/5 border border-[#44FF44]/30 rounded-lg focus:border-[#44FF44] focus:ring-2 focus:ring-[#44FF44]/20 focus:outline-none text-white transition-all @error('email') border-red-500 @enderror"
                            placeholder="rick@dimension-c137.com">
                        <button 
                            type="button" 
                            id="send-otp"
                            class="px-6 py-3 bg-gradient-to-r from-[#44FF44] to-[#00B5CC] hover:from-[#00B5CC] hover:to-[#44FF44] text-black font-semibold rounded-lg transition-all transform hover:scale-105 active:scale-95 whitespace-nowrap shadow-lg hover:shadow-[#44FF44]/30">
                            Send OTP
                        </button>
                    </div>
                    @error('email')
                        <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- OTP Input -->
                <div>
                    <label for="otp" class="block text-gray-300 text-sm font-semibold mb-2">
                        Verification Code
                    </label>
                    <input 
                        id="otp" 
                        name="otp" 
                        type="text" 
                        value="{{ old('otp') }}"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        class="w-full px-4 py-3 bg-white/5 border border-[#44FF44]/30 rounded-lg focus:border-[#44FF44] focus:ring-2 focus:ring-[#44FF44]/20 focus:outline-none text-white transition-all @error('otp') border-red-500 @enderror"
                        placeholder="Enter 6-digit code">
                    @error('otp')
                        <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Check your email for the verification code</p>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-300 text-sm font-semibold mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required
                            autocomplete="new-password"
                            minlength="8"
                            maxlength="255"
                            class="w-full px-4 py-3 bg-white/5 border border-[#44FF44]/30 rounded-lg focus:border-[#44FF44] focus:ring-2 focus:ring-[#44FF44]/20 focus:outline-none text-white transition-all @error('password') border-red-500 @enderror"
                            placeholder="Min. 8 characters">
                        <button 
                            type="button" 
                            id="toggle-password"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#44FF44] transition">
                            <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                    
                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="flex gap-1 mb-2">
                            <div id="strength-1" class="h-1 flex-1 bg-gray-700 rounded transition-all"></div>
                            <div id="strength-2" class="h-1 flex-1 bg-gray-700 rounded transition-all"></div>
                            <div id="strength-3" class="h-1 flex-1 bg-gray-700 rounded transition-all"></div>
                            <div id="strength-4" class="h-1 flex-1 bg-gray-700 rounded transition-all"></div>
                        </div>
                        <p id="strength-text" class="text-xs text-gray-500">Password strength: None</p>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password-confirm" class="block text-gray-300 text-sm font-semibold mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password-confirm" 
                            type="password" 
                            name="password_confirmation" 
                            required
                            autocomplete="new-password"
                            maxlength="255"
                            class="w-full px-4 py-3 bg-white/5 border border-[#44FF44]/30 rounded-lg focus:border-[#44FF44] focus:ring-2 focus:ring-[#44FF44]/20 focus:outline-none text-white transition-all"
                            placeholder="Re-enter password">
                        <button 
                            type="button" 
                            id="toggle-confirm"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#44FF44] transition">
                            <svg id="eye-icon-confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <p id="match-message" class="text-xs mt-1 hidden"></p>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="btn-portal w-full py-3 px-6 bg-gradient-to-r from-[#44FF44] to-[#00B5CC] text-black font-bold rounded-lg hover:shadow-lg hover:shadow-[#44FF44]/50 transition-all transform hover:scale-[1.02] active:scale-[0.98] relative z-10 mt-6">
                    <span class="relative z-10">Create Account</span>
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 flex items-center gap-3">
                <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-600 to-transparent"></div>
                <span class="text-gray-500 text-xs font-semibold">HAVE ACCOUNT?</span>
                <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-600 to-transparent"></div>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-gray-400 text-sm mb-3">
                    Access your existing portal
                </p>
                <a href="{{ route('login') }}" class="inline-block px-4 py-2 border border-[#44FF44]/50 text-[#44FF44] hover:bg-[#44FF44]/10 rounded-lg font-semibold text-sm transition-all hover:border-[#44FF44]">
                    Login to Portal
                </a>
            </div>
        </div>

        <!-- Security Badge -->
        <div class="mt-6 flex justify-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#44FF44]/10 to-[#00B5CC]/10 border border-[#44FF44]/30 rounded-lg">
                <span class="inline-block w-2 h-2 bg-[#44FF44] rounded-full animate-pulse"></span>
                <p class="text-gray-400 text-xs font-medium">OTP Verified & Encrypted</p>
            </div>
        </div>
    </div>
</div>

<style>
    .glow-text {
        text-shadow: 0 0 20px rgba(68, 255, 68, 0.8);
    }
    .glass {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .floating-particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(68, 255, 68, 0.6);
        border-radius: 50%;
        animation: float 6s infinite ease-in-out;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0) translateX(0); opacity: 0; }
        50% { opacity: 1; }
    }
    .btn-portal {
        position: relative;
        overflow: hidden;
    }
    .btn-portal::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    .btn-portal:hover::before {
        width: 300px;
        height: 300px;
    }
</style>
@endsection

@section('scripts')
<script>
// Animated particles
const particlesContainer = document.getElementById('particles');
if (particlesContainer) {
    for (let i = 0; i < 15; i++) {
        const particle = document.createElement('div');
        particle.className = 'floating-particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 6 + 's';
        particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
        particlesContainer.appendChild(particle);
    }
}

// Send OTP with security measures
(() => {
    const sendOtpBtn = document.getElementById('send-otp');
    const emailInput = document.getElementById('email');
    const otpInput = document.getElementById('otp');
    let otpCooldown = false;

    sendOtpBtn?.addEventListener('click', async () => {
        const email = emailInput.value.trim();
        
        // Validation
        if (!email) {
            alert('Please enter an email address first');
            emailInput.focus();
            return;
        }

        // Email format validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address');
            emailInput.focus();
            return;
        }

        // Prevent spam
        if (otpCooldown) {
            alert('Please wait before requesting another OTP');
            return;
        }

        sendOtpBtn.disabled = true;
        sendOtpBtn.innerText = 'Sending...';
        otpCooldown = true;

        try {
            const res = await fetch("{{ route('send.otp') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || "{{ csrf_token() }}"
                },
                body: JSON.stringify({ email })
            });

            if (!res.ok) {
                throw new Error(`HTTP error! status: ${res.status}`);
            }

            const text = await res.text();
            let data;
            
            try {
                data = JSON.parse(text);
            } catch (err) {
                console.error('Invalid JSON response:', text);
                alert('Server error. Please try again later.');
                return;
            }

            if (data.success) {
                alert(data.message || 'OTP sent successfully! Check your email.');
                otpInput.focus();
                
                // Cooldown timer (60 seconds)
                let countdown = 60;
                const interval = setInterval(() => {
                    countdown--;
                    sendOtpBtn.innerText = `Resend (${countdown}s)`;
                    if (countdown <= 0) {
                        clearInterval(interval);
                        otpCooldown = false;
                        sendOtpBtn.disabled = false;
                        sendOtpBtn.innerText = 'Send OTP';
                    }
                }, 1000);
            } else {
                alert(data.message || 'Failed to send OTP. Please try again.');
                otpCooldown = false;
                sendOtpBtn.disabled = false;
                sendOtpBtn.innerText = 'Send OTP';
            }
        } catch (err) {
            console.error('Network error:', err);
            alert('Network error. Please check your connection and try again.');
            otpCooldown = false;
            sendOtpBtn.disabled = false;
            sendOtpBtn.innerText = 'Send OTP';
        }
    });
})();

// Password visibility toggle
const togglePassword = document.getElementById('toggle-password');
const passwordInput = document.getElementById('password');
const eyeIcon = document.getElementById('eye-icon');

togglePassword?.addEventListener('click', () => {
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;
    
    if (type === 'text') {
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
    } else {
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
});

const toggleConfirm = document.getElementById('toggle-confirm');
const confirmInput = document.getElementById('password-confirm');
const eyeIconConfirm = document.getElementById('eye-icon-confirm');

toggleConfirm?.addEventListener('click', () => {
    const type = confirmInput.type === 'password' ? 'text' : 'password';
    confirmInput.type = type;
    
    if (type === 'text') {
        eyeIconConfirm.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
    } else {
        eyeIconConfirm.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
});

// Password strength checker
passwordInput?.addEventListener('input', () => {
    const password = passwordInput.value;
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;
    
    const indicators = ['strength-1', 'strength-2', 'strength-3', 'strength-4'];
    const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
    const texts = ['Weak', 'Fair', 'Good', 'Strong'];
    
    indicators.forEach((id, index) => {
        const el = document.getElementById(id);
        el.className = 'h-1 flex-1 rounded transition-all ' + (index < strength ? colors[strength - 1] : 'bg-gray-700');
    });
    
    const strengthText = document.getElementById('strength-text');
    if (password.length === 0) {
        strengthText.textContent = 'Password strength: None';
        strengthText.className = 'text-xs text-gray-500';
    } else {
        strengthText.textContent = `Password strength: ${texts[strength - 1] || 'Very Weak'}`;
        strengthText.className = `text-xs ${strength >= 3 ? 'text-green-400' : strength >= 2 ? 'text-yellow-400' : 'text-red-400'}`;
    }
});

// Password match checker
confirmInput?.addEventListener('input', () => {
    const password = passwordInput.value;
    const confirm = confirmInput.value;
    const matchMsg = document.getElementById('match-message');
    
    if (confirm.length === 0) {
        matchMsg.classList.add('hidden');
    } else if (password === confirm) {
        matchMsg.textContent = '✓ Passwords match';
        matchMsg.className = 'text-xs mt-1 text-green-400';
    } else {
        matchMsg.textContent = '✗ Passwords do not match';
        matchMsg.className = 'text-xs mt-1 text-red-400';
    }
});

// Form validation
const registerForm = document.getElementById('register-form');
let submitted = false;

registerForm?.addEventListener('submit', (e) => {
    if (submitted) {
        e.preventDefault();
        return;
    }

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const otp = document.getElementById('otp').value.trim();
    const password = passwordInput.value;
    const confirm = confirmInput.value;

    // Validate all fields
    if (!name || !email || !otp || !password || !confirm) {
        e.preventDefault();
        alert('Please fill in all required fields');
        return;
    }

    // Name validation (letters and spaces only)
    if (!/^[A-Za-z\s]+$/.test(name)) {
        e.preventDefault();
        alert('Name should only contain letters and spaces');
        document.getElementById('name').focus();
        return;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address');
        document.getElementById('email').focus();
        return;
    }

    // OTP validation (6 digits)
    if (!/^\d{6}$/.test(otp)) {
        e.preventDefault();
        alert('OTP must be exactly 6 digits');
        otpInput.focus();
        return;
    }

    // Password length
    if (password.length < 8) {
        e.preventDefault();
        alert('Password must be at least 8 characters long');
        passwordInput.focus();
        return;
    }

    // Password match
    if (password !== confirm) {
        e.preventDefault();
        alert('Passwords do not match');
        confirmInput.focus();
        return;
    }

    // Prevent double submission
    submitted = true;
    const btn = registerForm.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<span class="relative z-10">Creating Account...</span>';
});

// Input sanitization (prevent basic XSS)
document.querySelectorAll('input[type="text"], input[type="email"]').forEach(input => {
    input.addEventListener('input', (e) => {
        // Remove potentially dangerous characters
        e.target.value = e.target.value.replace(/[<>]/g, '');
    });
});
</script>
@endsection