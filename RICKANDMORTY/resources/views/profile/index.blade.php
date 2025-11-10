@extends('layouts.app')

@section('title', 'Profile Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section with Gradient -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-portal-green/20 via-portal-blue/20 to-purple-900/20 border border-portal-green/30 p-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-portal-green/10 via-transparent to-transparent"></div>
            <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <!-- Avatar Circle -->
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-portal-green to-portal-blue flex items-center justify-center text-4xl font-bold text-white shadow-lg shadow-portal-green/50 ring-4 ring-portal-green/20">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-4xl font-orbitron text-white mb-2">{{ $user->name }}</h1>
                        <p class="text-portal-green/80 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            {{ $user->email }}
                        </p>
                        <p class="text-gray-400 text-sm mt-1">
                            Member since {{ $user->created_at->format('F d, Y') }}
                        </p>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="glass-effect rounded-xl p-4 border border-portal-blue/30 text-center min-w-[120px]">
                    <div class="text-3xl font-bold text-portal-blue">{{ $favorites->count() }}</div>
                    <div class="text-xs text-gray-400 mt-1">Favorites</div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content Area -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Security Settings Card -->
            <div class="glass-effect rounded-2xl p-6 border border-portal-green/30 portal-glow">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-portal-green/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-portal-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-orbitron text-white">Security Settings</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password Reset via Email -->
                    <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-portal-blue/10 to-portal-blue/5 border border-portal-blue/30 p-6 hover:border-portal-blue/60 transition-all duration-300">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-portal-blue/10 rounded-full blur-2xl group-hover:bg-portal-blue/20 transition-all"></div>
                        <div class="relative">
                            <div class="w-12 h-12 rounded-lg bg-portal-blue/20 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-portal-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-2">Reset via Email</h3>
                            <p class="text-gray-400 text-sm mb-4 leading-relaxed">
                                Can't remember your password? We'll send a secure reset link to your email address.
                            </p>
                            <a href="{{ route('password.request') }}" 
                               class="inline-flex items-center gap-2 px-5 py-2.5 bg-portal-blue/20 hover:bg-portal-blue/40 border border-portal-blue rounded-lg text-sm font-medium text-white transition-all duration-300 group-hover:translate-x-1">
                                <span>Send Reset Link</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Change Password Form -->
                    <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-portal-green/10 to-portal-green/5 border border-portal-green/30 p-6 hover:border-portal-green/60 transition-all duration-300">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-portal-green/10 rounded-full blur-2xl group-hover:bg-portal-green/20 transition-all"></div>
                        <div class="relative">
                            <div class="w-12 h-12 rounded-lg bg-portal-green/20 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-portal-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-2">Change Password</h3>
                            <p class="text-gray-400 text-sm mb-4 leading-relaxed">
                                Update your password immediately. Requires current password verification.
                            </p>
                            <button type="button" onclick="document.getElementById('passwordModal').classList.remove('hidden')"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-portal-green/20 hover:bg-portal-green/40 border border-portal-green rounded-lg text-sm font-medium text-white transition-all duration-300 group-hover:translate-x-1">
                                <span>Update Password</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Favorite Characters Section -->
            <div class="glass-effect rounded-2xl p-6 border border-portal-green/30 portal-glow">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-red-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-orbitron text-white">Favorite Characters</h2>
                    </div>
                    @if (!$favorites->isEmpty())
                        <span class="px-3 py-1 rounded-full bg-portal-green/20 text-portal-green text-sm font-semibold">
                            {{ $favorites->count() }} Total
                        </span>
                    @endif
                </div>

                @if ($favorites->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-800/50 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-lg mb-2">No favorites yet</p>
                        <p class="text-gray-500 text-sm">Explore the multiverse and add your favorite characters!</p>
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach ($favorites as $fav)
                            <div class="group relative overflow-hidden rounded-xl bg-black/40 border border-gray-700/50 hover:border-portal-green/60 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-portal-green/20">
                                <!-- Image Container -->
                                <div class="relative aspect-[3/4] overflow-hidden">
                                    @if ($fav->image)
                                        <img src="{{ $fav->image }}" alt="{{ $fav->name }}" 
                                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                                </div>

                                <!-- Character Info -->
                                <div class="absolute bottom-0 left-0 right-0 p-3">
                                    <h3 class="text-white font-semibold text-sm mb-1 line-clamp-1">{{ $fav->name }}</h3>
                                    <a href="{{ route('characters.show', $fav->character_id) }}" 
                                       class="inline-flex items-center gap-1 text-xs text-portal-green hover:text-portal-blue transition group">
                                        <span>View Details</span>
                                        <svg class="w-3 h-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>

                                <!-- Heart Icon Badge -->
                                <div class="absolute top-2 right-2 w-8 h-8 rounded-full bg-red-500/80 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Account Info Card -->
            <div class="glass-effect rounded-2xl p-6 border border-portal-blue/30">
                <h3 class="text-lg font-orbitron text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-portal-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Account Information
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start gap-3 p-3 rounded-lg bg-black/20">
                        <svg class="w-5 h-5 text-portal-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <div>
                            <div class="text-xs text-gray-400">Username</div>
                            <div class="text-sm text-white font-medium">{{ $user->name }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 rounded-lg bg-black/20">
                        <svg class="w-5 h-5 text-portal-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <div class="text-xs text-gray-400">Email Address</div>
                            <div class="text-sm text-white font-medium break-all">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 rounded-lg bg-black/20">
                        <svg class="w-5 h-5 text-portal-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <div class="text-xs text-gray-400">Member Since</div>
                            <div class="text-sm text-white font-medium">{{ $user->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Card -->
            <div class="glass-effect rounded-2xl p-6 border border-purple-500/30">
                <h3 class="text-lg font-orbitron text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Recent Activity
                </h3>
                <div class="space-y-2">
                    <div class="flex items-center gap-3 text-sm text-gray-400">
                        <div class="w-2 h-2 rounded-full bg-portal-green"></div>
                        <span>Logged in today</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-400">
                        <div class="w-2 h-2 rounded-full bg-portal-blue"></div>
                        <span>{{ $favorites->count() }} favorites added</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-400">
                        <div class="w-2 h-2 rounded-full bg-purple-400"></div>
                        <span>Account created {{ $user->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password Change Modal -->
<div id="passwordModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-[9999] flex items-center justify-center p-4" onclick="if(event.target === this) this.classList.add('hidden')">
    <div class="glass-effect rounded-2xl border border-portal-green/30 max-w-md w-full p-6 portal-glow relative max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <!-- Close Button -->
        <button type="button" onclick="document.getElementById('passwordModal').classList.add('hidden')" 
                class="absolute top-4 right-4 text-gray-400 hover:text-white transition z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="mb-6">
            <div class="w-12 h-12 rounded-lg bg-portal-green/20 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-portal-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-orbitron text-white">Change Password</h2>
            <p class="text-gray-400 text-sm mt-1">Enter your current password and choose a new one</p>
        </div>

        {{-- Flash & Validation Messages --}}
        @if (session('status'))
            <div class="mb-4 p-3 rounded-lg bg-green-900/40 border border-green-600 text-green-200 flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-900/40 border border-red-600 text-red-200">
                <div class="flex items-start gap-2 mb-2">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <ul class="text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('profile.password.update') }}" method="POST" novalidate>
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">
                        Current Password
                    </label>
                    <input id="current_password" name="current_password" type="password" required
                           class="w-full px-4 py-3 rounded-lg bg-black/40 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-portal-green focus:border-transparent transition">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                        New Password
                    </label>
                    <input id="password" name="password" type="password" required
                           class="w-full px-4 py-3 rounded-lg bg-black/40 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-portal-green focus:border-transparent transition">
                    <p class="text-xs text-gray-500 mt-1.5">Minimum 8 characters required</p>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                        Confirm New Password
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="w-full px-4 py-3 rounded-lg bg-black/40 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-portal-green focus:border-transparent transition">
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="button" onclick="document.getElementById('passwordModal').classList.add('hidden')"
                        class="flex-1 px-4 py-3 rounded-lg border border-gray-700 text-gray-300 font-medium hover:bg-gray-800 transition">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-3 rounded-lg bg-portal-green text-black font-semibold hover:brightness-110 transition shadow-lg shadow-portal-green/20">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Show modal if there are errors
@if ($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('passwordModal').classList.remove('hidden');
    });
@endif

// Show modal if there's a success status
@if (session('status'))
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('passwordModal').classList.remove('hidden');
        // Auto-hide success message after 3 seconds
        setTimeout(function() {
            const statusDiv = document.querySelector('.bg-green-900\\/40');
            if (statusDiv) {
                statusDiv.style.transition = 'opacity 0.5s';
                statusDiv.style.opacity = '0';
                setTimeout(() => statusDiv.remove(), 500);
            }
        }, 3000);
    });
@endif
</script>
@endsection