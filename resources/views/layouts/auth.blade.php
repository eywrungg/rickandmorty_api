<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rick and Morty Portal | @yield('title', 'Access Portal')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="min-h-screen bg-[#10212b] font-sans text-[#f8f6df] antialiased selection:bg-[#fff874] selection:text-[#10212b]">
    <main class="relative isolate grid min-h-screen place-items-center overflow-hidden px-4 py-10">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_18%_14%,rgba(151,206,76,.2),transparent_30%),radial-gradient(circle_at_84%_84%,rgba(1,180,198,.18),transparent_30%),linear-gradient(135deg,#10212b,#17313f_52%,#10212b)]"></div>
        <div class="w-full @yield('auth-card-width', 'max-w-md') rounded-xl border border-white/10 bg-white/[0.055] p-5 shadow-2xl shadow-black/30 backdrop-blur-xl sm:p-6">
            @yield('content')
        </div>
    </main>
    @yield('scripts')
</body>
</html>
