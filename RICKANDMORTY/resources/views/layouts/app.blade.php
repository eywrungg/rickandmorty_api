<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title', 'Explore the Multiverse')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'orbitron': ['Orbitron', 'sans-serif'],
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'portal': {
                            'green': '#44FF44',
                            'blue': '#00B5CC',
                            'dark': '#0A0E27',
                            'darker': '#050814',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0A0E27;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(68, 255, 68, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(0, 181, 204, 0.03) 0%, transparent 50%);
            min-height: 100vh;
        }

        /* Navigation - Premium Glass Morphism */
        .glass-effect {
            background: rgba(10, 14, 39, 0.75);
            backdrop-filter: blur(40px) saturate(180%);
            -webkit-backdrop-filter: blur(40px) saturate(180%);
            border-bottom: 1px solid rgba(68, 255, 68, 0.1);
            box-shadow: 
                0 8px 32px 0 rgba(0, 0, 0, 0.37),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.05);
        }

        nav {
            position: relative;
        }

        nav::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(68, 255, 68, 0.5) 20%,
                rgba(0, 181, 204, 0.5) 50%,
                rgba(68, 255, 68, 0.5) 80%,
                transparent 100%
            );
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        nav:hover::after {
            opacity: 1;
        }

        /* Logo - Quantum Particles Effect */
        nav .font-orbitron {
            position: relative;
            cursor: pointer;
        }

        nav .font-orbitron span:first-child {
            display: inline-block;
            font-size: 2rem;
            transition: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
        }

        nav .font-orbitron span:first-child::before,
        nav .font-orbitron span:first-child::after {
            content: '⚛';
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            color: #44FF44;
            filter: blur(8px);
        }

        nav .font-orbitron:hover span:first-child {
            transform: rotate(360deg) scale(1.2);
            filter: drop-shadow(0 0 20px #44FF44) drop-shadow(0 0 40px #44FF44);
        }

        nav .font-orbitron:hover span:first-child::before {
            animation: particle-1 1.5s ease-out forwards;
        }

        nav .font-orbitron:hover span:first-child::after {
            animation: particle-2 1.5s ease-out forwards;
        }

        @keyframes particle-1 {
            0% { opacity: 1; transform: translate(0, 0) scale(1); }
            100% { opacity: 0; transform: translate(-30px, -30px) scale(0.3); }
        }

        @keyframes particle-2 {
            0% { opacity: 1; transform: translate(0, 0) scale(1); }
            100% { opacity: 0; transform: translate(30px, -30px) scale(0.3); }
        }

        nav .font-orbitron span:last-child {
            background: linear-gradient(120deg, 
                #44FF44 0%, 
                #00B5CC 25%,
                #44FF44 50%,
                #00B5CC 75%,
                #44FF44 100%
            );
            background-size: 300% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: text-shimmer 8s ease-in-out infinite;
            font-weight: 900;
            letter-spacing: 1px;
        }

        @keyframes text-shimmer {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 100% center; }
        }

        /* Navigation Links - Liquid Hover Effect */
        nav .hidden a {
            position: relative;
            padding: 0.75rem 1.5rem;
            color: #9ca3af;
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            overflow: hidden;
            border-radius: 12px;
            cursor: pointer;
            display: inline-block;
        }

        nav .hidden a::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at var(--x, 50%) var(--y, 50%), 
                rgba(68, 255, 68, 0.2) 0%,
                rgba(68, 255, 68, 0.1) 30%,
                transparent 60%
            );
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 0;
        }

        nav .hidden a:hover::before {
            opacity: 1;
        }

        nav .hidden a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #44FF44, #00B5CC, #44FF44, transparent);
            background-size: 200% 100%;
            transform: translateX(-50%);
            transition: width 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            z-index: 1;
        }

        nav .hidden a:hover::after {
            width: 90%;
            animation: glow-slide 2s linear infinite;
        }

        @keyframes glow-slide {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        nav .hidden a:hover {
            color: #44FF44 !important;
            text-shadow: 
                0 0 20px rgba(68, 255, 68, 0.8),
                0 0 40px rgba(68, 255, 68, 0.4);
            transform: translateY(-3px);
            background: rgba(68, 255, 68, 0.12);
            letter-spacing: 1px;
            box-shadow: 0 4px 20px rgba(68, 255, 68, 0.2);
        }

        nav .hidden a:active {
            transform: translateY(0) scale(0.98);
        }

        /* Username - Holographic Badge */
        .flex.items-center.space-x-4 > a {
            position: relative;
            padding: 0.625rem 1.5rem;
            background: linear-gradient(135deg, 
                rgba(68, 255, 68, 0.05) 0%, 
                rgba(0, 181, 204, 0.05) 100%
            );
            border: 1.5px solid rgba(68, 255, 68, 0.2);
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
            cursor: pointer;
        }

        .flex.items-center.space-x-4 > a::before {
            content: '';
            position: absolute;
            inset: -100%;
            background: conic-gradient(
                from 0deg at 50% 50%,
                rgba(68, 255, 68, 0) 0deg,
                rgba(68, 255, 68, 0.4) 60deg,
                rgba(0, 181, 204, 0.4) 120deg,
                rgba(68, 255, 68, 0) 180deg,
                rgba(68, 255, 68, 0.4) 240deg,
                rgba(0, 181, 204, 0.4) 300deg,
                rgba(68, 255, 68, 0) 360deg
            );
            animation: spin 4s linear infinite;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .flex.items-center.space-x-4 > a::after {
            content: '';
            position: absolute;
            inset: 2px;
            background: rgba(10, 14, 39, 0.95);
            border-radius: 50px;
            z-index: -1;
        }

        .flex.items-center.space-x-4 > a:hover::before {
            opacity: 1;
        }

        .flex.items-center.space-x-4 > a:hover {
            transform: scale(1.08) translateY(-2px);
            color: #44FF44;
            text-shadow: 0 0 15px rgba(68, 255, 68, 0.8);
            border-color: #44FF44;
            box-shadow: 
                0 8px 32px rgba(68, 255, 68, 0.25),
                0 0 0 1px rgba(68, 255, 68, 0.1) inset,
                0 20px 60px rgba(68, 255, 68, 0.15);
            letter-spacing: 1px;
        }

        /* Logout - Danger Zone Effect */
        nav form {
            display: inline-block;
        }

        nav form button {
            position: relative;
            padding: 0.625rem 1.5rem;
            background: rgba(239, 68, 68, 0.08);
            border: 1.5px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            color: #fca5a5;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        nav form button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.4) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        nav form button::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 12px;
            padding: 2px;
            background: linear-gradient(45deg, 
                #ef4444, 
                #dc2626, 
                #b91c1c, 
                #ef4444
            );
            background-size: 300% 300%;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            animation: border-dance 3s ease infinite;
        }

        @keyframes border-dance {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        nav form button:hover::before {
            width: 500px;
            height: 500px;
        }

        nav form button:hover::after {
            opacity: 1;
        }

        nav form button:hover {
            transform: scale(1.05) translateY(-2px);
            color: #ffffff;
            text-shadow: 0 0 20px rgba(239, 68, 68, 0.8);
            border-color: #ef4444;
            background: rgba(239, 68, 68, 0.15);
            box-shadow: 
                0 8px 32px rgba(239, 68, 68, 0.4),
                0 0 60px rgba(239, 68, 68, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            letter-spacing: 1px;
        }

        nav form button:active {
            transform: scale(0.98);
        }

        /* Footer - Portal Gateway */
        footer {
            background: rgba(10, 14, 39, 0.6);
            backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent,
                rgba(68, 255, 68, 0.8),
                rgba(0, 181, 204, 0.8),
                rgba(68, 255, 68, 0.8),
                transparent
            );
            animation: scan 5s ease-in-out infinite;
            filter: drop-shadow(0 0 6px rgba(68, 255, 68, 0.8));
        }

        @keyframes scan {
            0%, 100% { left: -100%; opacity: 0; }
            10%, 90% { opacity: 1; }
            50% { left: 100%; }
        }

        footer::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(68, 255, 68, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse-circle 4s ease-in-out infinite;
        }

        @keyframes pulse-circle {
            0%, 100% { transform: translateX(-50%) scale(0.8); opacity: 0.3; }
            50% { transform: translateX(-50%) scale(1.2); opacity: 0.6; }
        }

        footer .font-orbitron {
            display: inline-block;
            position: relative;
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
        }

        footer .font-orbitron::before {
            content: '⚛';
            position: absolute;
            left: -35px;
            top: 50%;
            transform: translateY(-50%) scale(0) rotate(0deg);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            filter: drop-shadow(0 0 10px #44FF44);
        }

        footer .font-orbitron::after {
            content: '⚛';
            position: absolute;
            right: -35px;
            top: 50%;
            transform: translateY(-50%) scale(0) rotate(0deg);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            filter: drop-shadow(0 0 10px #00B5CC);
        }

        footer .font-orbitron:hover {
            color: #44FF44;
            text-shadow: 0 0 30px rgba(68, 255, 68, 0.8);
            letter-spacing: 3px;
            transform: scale(1.15);
        }

        footer .font-orbitron:hover::before {
            transform: translateY(-50%) scale(1) rotate(360deg);
            opacity: 1;
        }

        footer .font-orbitron:hover::after {
            transform: translateY(-50%) scale(1) rotate(-360deg);
            opacity: 1;
        }

        footer .text-sm:last-child {
            display: inline-block;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
            position: relative;
        }

        footer .text-sm:last-child:hover {
            color: #00B5CC;
            text-shadow: 0 0 20px rgba(0, 181, 204, 0.8);
            transform: scale(1.2) translateY(-5px);
            filter: drop-shadow(0 4px 8px rgba(0, 181, 204, 0.3));
        }

        .portal-glow {
            box-shadow: 0 0 30px rgba(68, 255, 68, 0.3), 0 0 60px rgba(68, 255, 68, 0.1);
        }
        .portal-border {
            border: 2px solid rgba(68, 255, 68, 0.4);
        }
        .portal-text {
            text-shadow: 0 0 10px rgba(68, 255, 68, 0.5);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(68, 255, 68, 0.3); }
            50% { box-shadow: 0 0 40px rgba(68, 255, 68, 0.6); }
        }
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="font-inter text-gray-100">
    <nav class="glass-effect sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('dashboard') }}" class="font-orbitron text-2xl font-bold flex items-center space-x-2">
                    <span class="text-portal-green">⚛</span>
                    <span>R&M Portal</span>
                </a>

                @auth
                <div class="hidden md:flex space-x-4">
                    <a href="{{ route('dashboard') }}">Home</a>
                    <a href="{{ route('characters.index') }}">Characters</a>
                    <a href="{{ route('episodes.index') }}">Episodes</a>
                    <a href="{{ route('favorites.index') }}">Favorites</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('profile.index') }}" class="text-sm text-gray-300 font-semibold">
                        {{ Auth::user()->name }}
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            Logout
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="py-8">
        @yield('content')
    </main>

    <footer class="mt-16 py-8">
        <div class="container mx-auto px-4 text-center text-gray-400">
            <p class="font-orbitron text-sm">Powered by Rick and Morty API</p>
            <p class="text-sm mt-3">Interdimensional Adventures Await 🚀</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Track mouse position for radial gradient effects on nav links
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('nav .hidden a');
            
            navLinks.forEach(link => {
                link.addEventListener('mousemove', (e) => {
                    const rect = link.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width) * 100;
                    const y = ((e.clientY - rect.top) / rect.height) * 100;
                    link.style.setProperty('--x', x + '%');
                    link.style.setProperty('--y', y + '%');
                });
            });
        });
    </script>
    @yield('scripts')
</body>
</html>