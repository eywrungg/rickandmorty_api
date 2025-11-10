<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Rick and Morty Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #0A0E27 0%, #1a1f3a 50%, #0A0E27 100%);
            min-height: 100vh;
        }
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
</head>
<body class="font-['Inter'] relative overflow-x-hidden">
    <!-- Animated Background Particles -->
    <div class="fixed inset-0 pointer-events-none" id="particles"></div>

    <div class="min-h-screen flex items-center justify-center px-4 relative z-10">
        <div class="max-w-md w-full">
            <!-- Header -->
            <div class="text-center mb-8 animate-fade-in">
                <a href="/" class="inline-block group">
                    <h1 class="font-['Orbitron'] text-5xl font-black text-white glow-text mb-2 transition-transform group-hover:scale-105">
                        ⚛ R&M PORTAL
                    </h1>
                </a>
                <p class="text-gray-400 text-lg">Login to access the multiverse</p>
            </div>

            <!-- Login Form -->
            <div class="glass rounded-2xl p-8 shadow-2xl transform transition-all hover:shadow-[#44FF44]/20">
                <h2 class="text-2xl font-bold text-white mb-2">Welcome Back</h2>
                <p class="text-gray-400 text-sm mb-6">Enter your credentials to continue</p>

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

                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-300 text-sm font-semibold mb-2">
                            Email Address
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                            autocomplete="email"
                            maxlength="255"
                            class="w-full px-4 py-3 bg-white/5 border border-[#44FF44]/30 rounded-lg focus:border-[#44FF44] focus:ring-2 focus:ring-[#44FF44]/20 focus:outline-none text-white transition-all @error('email') border-red-500 @enderror"
                            placeholder="rick@dimension-c137.com">
                        @error('email')
                            <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-300 text-sm font-semibold mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required
                                autocomplete="current-password"
                                maxlength="255"
                                class="w-full px-4 py-3 bg-white/5 border border-[#44FF44]/30 rounded-lg focus:border-[#44FF44] focus:ring-2 focus:ring-[#44FF44]/20 focus:outline-none text-white transition-all @error('password') border-red-500 @enderror"
                                placeholder="Enter your password">
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
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center text-gray-400 text-sm cursor-pointer group">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="mr-2 rounded border-[#44FF44]/30 text-[#44FF44] focus:ring-[#44FF44] focus:ring-offset-0 bg-white/5">
                            <span class="group-hover:text-gray-300 transition">Remember Me</span>
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[#44FF44] text-sm hover:text-[#00B5CC] transition">
                            Forgot Password?
                        </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="btn-portal w-full py-3 px-6 bg-gradient-to-r from-[#44FF44] to-[#00B5CC] text-black font-bold rounded-lg hover:shadow-lg hover:shadow-[#44FF44]/50 transition-all transform hover:scale-[1.02] active:scale-[0.98] relative z-10">
                        <span class="relative z-10">Login to Portal</span>
                    </button>
                </form>

                <!-- Register Link -->
                <div class="mt-6 pt-6 border-t border-gray-700 text-center">
                    <p class="text-gray-400 text-sm">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-[#44FF44] hover:text-[#00B5CC] font-semibold transition">
                            Register here
                        </a>
                    </p>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="mt-6 text-center">
                <p class="text-gray-500 text-xs">
                    🔒 Secured with enterprise-grade encryption
                </p>
            </div>
        </div>
    </div>

    <script>
        // Animated particles
        const particlesContainer = document.getElementById('particles');
        for (let i = 0; i < 15; i++) {
            const particle = document.createElement('div');
            particle.className = 'floating-particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 6 + 's';
            particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
            particlesContainer.appendChild(particle);
        }

        // Toggle password visibility
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

        // Form validation & security
        const loginForm = document.getElementById('login-form');
        loginForm?.addEventListener('submit', (e) => {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            // Basic client-side validation
            if (!email || !password) {
                e.preventDefault();
                alert('Please fill in all fields');
                return;
            }

            // Email format validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address');
                return;
            }
        });

        // Prevent multiple form submissions
        let submitted = false;
        loginForm?.addEventListener('submit', (e) => {
            if (submitted) {
                e.preventDefault();
                return;
            }
            submitted = true;
            const btn = loginForm.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<span class="relative z-10">Logging in...</span>';
        });
    </script>
</body>
</html>