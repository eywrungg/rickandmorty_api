<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rick and Morty Portal | @yield('title', 'Explore the Multiverse')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="min-h-screen bg-[#10212b] font-sans text-[#f8f6df] antialiased selection:bg-[#fff874] selection:text-[#10212b]">
    @php
        $navBase = 'inline-flex min-h-11 items-center gap-2 rounded-lg px-4 text-sm font-bold transition duration-200';
        $navIdle = 'text-slate-300 hover:bg-white/[0.07] hover:text-white';
        $navActive = 'bg-[#97ce4c] text-[#10212b] shadow-[0_0_26px_rgba(151,206,76,.24)]';
        $buttonDark = 'inline-flex min-h-11 items-center justify-center gap-2 rounded-lg border border-white/10 bg-white/[0.04] px-4 text-sm font-bold text-white transition hover:border-[#01b4c6]/45 hover:bg-[#01b4c6]/12';
        $buttonLime = 'inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-[#97ce4c] px-5 text-sm font-extrabold text-[#10212b] shadow-[0_0_30px_rgba(151,206,76,.26)] transition hover:-translate-y-0.5 hover:bg-[#fff874]';
    @endphp

    <header class="sticky top-0 z-50 border-b border-[#01b4c6]/20 bg-[#10212b]/[.92] backdrop-blur-xl">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex min-h-20 items-center justify-between gap-4">
                <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="group inline-flex items-center gap-3">
                    <span class="block h-11 w-11 overflow-hidden rounded-lg border border-[#97ce4c]/40 bg-[#97ce4c]/10 shadow-[0_0_24px_rgba(151,206,76,.2)] transition group-hover:rotate-3 group-hover:border-[#97ce4c]/75">
                        <img src="https://rickandmortyapi.com/api/character/avatar/103.jpeg" alt="Doofus Rick" class="h-full w-full object-cover">
                    </span>
                    <span class="font-display text-base font-extrabold uppercase tracking-[0.08em] text-white sm:text-lg">
                        Rick & Morty
                    </span>
                </a>

                <div class="hidden items-center gap-3 md:flex">
                    @auth
                        <nav class="flex items-center gap-1 rounded-xl border border-white/10 bg-white/[0.035] p-1">
                            <a href="{{ route('dashboard') }}" class="{{ $navBase }} {{ request()->routeIs('dashboard') ? $navActive : $navIdle }}">
                                <x-ui.icon name="portal" class="h-4 w-4" />
                                Dashboard
                            </a>
                            <a href="{{ route('characters.index') }}" class="{{ $navBase }} {{ request()->routeIs('characters.*') ? $navActive : $navIdle }}">
                                <x-ui.icon name="dossier" class="h-4 w-4" />
                                Characters
                            </a>
                            <a href="{{ route('episodes.index') }}" class="{{ $navBase }} {{ request()->routeIs('episodes.*') ? $navActive : $navIdle }}">
                                <x-ui.icon name="archive" class="h-4 w-4" />
                                Episodes
                            </a>
                            <a href="{{ route('favorites.index') }}" class="{{ $navBase }} {{ request()->routeIs('favorites.*') ? $navActive : $navIdle }}">
                                <x-ui.icon name="favorite" class="h-4 w-4" />
                                Favorites
                            </a>
                        </nav>

                        <a href="{{ route('profile.index') }}" class="inline-flex min-h-11 items-center gap-2 rounded-lg border border-[#01b4c6]/25 bg-[#01b4c6]/10 px-4 text-sm font-bold text-[#bee5fd] transition hover:border-[#01b4c6]/55">
                            <x-ui.icon name="profile" class="h-4 w-4" />
                            {{ Auth::user()->name }}
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="{{ $buttonDark }}">
                                <x-ui.icon name="logout" class="h-4 w-4" />
                                Logout
                            </button>
                        </form>
                    @else
                        <nav class="flex items-center gap-1 rounded-xl border border-white/10 bg-white/[0.035] p-1">
                            <a href="{{ route('home') }}" class="{{ $navBase }} {{ request()->routeIs('home') ? $navActive : $navIdle }}">
                                <x-ui.icon name="portal" class="h-4 w-4" />
                                Home
                            </a>
                            <a href="{{ route('login') }}" class="{{ $navBase }} {{ request()->routeIs('login') ? $navActive : $navIdle }}">
                                Login
                            </a>
                        </nav>
                        <a href="{{ route('register') }}" class="{{ $buttonLime }}">Register</a>
                    @endauth
                </div>

                <button class="grid h-11 w-11 place-items-center rounded-lg border border-white/10 bg-white/[0.05] text-white transition hover:border-[#97ce4c]/45 hover:bg-[#97ce4c]/12 md:hidden" data-nav-toggle="#mobileNav" type="button" aria-label="Open navigation">
                    <x-ui.icon name="menu" class="h-5 w-5" />
                </button>
            </div>

            <nav id="mobileNav" class="hidden pb-4 md:hidden">
                <div class="grid gap-2 rounded-xl border border-white/10 bg-[#17313f] p-2 shadow-2xl">
                    @auth
                        <a href="{{ route('dashboard') }}" class="{{ $navBase }} {{ request()->routeIs('dashboard') ? $navActive : $navIdle }}">
                            <x-ui.icon name="portal" class="h-4 w-4" />
                            Dashboard
                        </a>
                        <a href="{{ route('characters.index') }}" class="{{ $navBase }} {{ request()->routeIs('characters.*') ? $navActive : $navIdle }}">
                            <x-ui.icon name="dossier" class="h-4 w-4" />
                            Characters
                        </a>
                        <a href="{{ route('episodes.index') }}" class="{{ $navBase }} {{ request()->routeIs('episodes.*') ? $navActive : $navIdle }}">
                            <x-ui.icon name="archive" class="h-4 w-4" />
                            Episodes
                        </a>
                        <a href="{{ route('favorites.index') }}" class="{{ $navBase }} {{ request()->routeIs('favorites.*') ? $navActive : $navIdle }}">
                            <x-ui.icon name="favorite" class="h-4 w-4" />
                            Favorites
                        </a>
                        <a href="{{ route('profile.index') }}" class="{{ $navBase }} {{ request()->routeIs('profile.*') ? $navActive : $navIdle }}">
                            <x-ui.icon name="profile" class="h-4 w-4" />
                            Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="{{ $buttonDark }} w-full">
                                <x-ui.icon name="logout" class="h-4 w-4" />
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('home') }}" class="{{ $navBase }} {{ request()->routeIs('home') ? $navActive : $navIdle }}">
                            <x-ui.icon name="portal" class="h-4 w-4" />
                            Home
                        </a>
                        <a href="{{ route('login') }}" class="{{ $navBase }} {{ request()->routeIs('login') ? $navActive : $navIdle }}">Login</a>
                        <a href="{{ route('register') }}" class="{{ $buttonLime }}">Register</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main>
        @if(session('status') || session('error'))
            <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                @if(session('status'))
                    <div class="flex gap-3 rounded-lg border border-[#97ce4c]/30 bg-[#97ce4c]/12 p-4 text-sm font-semibold text-[#fff874]">
                        <x-ui.icon name="beacon" class="mt-0.5 h-5 w-5 flex-none" />
                        <p>{{ session('status') }}</p>
                    </div>
                @endif
                @if(session('error'))
                    <div class="flex gap-3 rounded-lg border border-red-400/25 bg-red-500/10 p-4 text-sm font-semibold text-red-100">
                        <x-ui.icon name="close" class="mt-0.5 h-5 w-5 flex-none" />
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mx-auto max-w-7xl px-4 py-10 text-sm text-slate-500 sm:px-6 lg:px-8">
        Powered by the Rick and Morty API for characters, episodes, and your personal favorites list.
    </footer>

    @yield('scripts')
</body>
</html>
