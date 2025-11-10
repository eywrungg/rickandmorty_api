@extends('layouts.app')

@section('title', 'Welcome to the Multiverse')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-900 text-white relative overflow-hidden">

    <!-- Particle Background Effect -->
    <div class="absolute inset-0 z-0">
        <div class="particles-container">
            @for($i = 0; $i < 50; $i++)
                <div class="particle" style="
                    --delay: {{ rand(0, 5000) }}ms;
                    --duration: {{ rand(15000, 30000) }}ms;
                    --x: {{ rand(0, 100) }}%;
                    --y: {{ rand(0, 100) }}%;
                "></div>
            @endfor
        </div>
        <div class="grid-overlay"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Hero Section -->
        <div class="py-20 lg:py-28">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                
                <!-- Left: Content -->
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/10 border border-emerald-500/30 rounded-full backdrop-blur-sm">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        <span class="text-emerald-400 text-sm font-medium tracking-wide">826 Characters Across Infinite Realities</span>
                    </div>
                    
                    <h1 class="text-6xl lg:text-7xl xl:text-8xl font-black tracking-tight">
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-500 animate-gradient">
                            Explore the
                        </span>
                        <span class="block mt-2 text-white drop-shadow-2xl">
                            Multiverse
                        </span>
                    </h1>
                    
                    <p class="text-xl text-slate-300 leading-relaxed max-w-xl">
                        Dive into the infinite dimensions of Rick & Morty. Track characters, relive epic adventures, and save your favorites across the multiverse.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="{{ route('characters.index') }}" 
                           class="group relative px-8 py-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl font-bold text-slate-900 shadow-xl shadow-emerald-500/25 hover:shadow-emerald-500/50 transition-all duration-300 hover:scale-105 overflow-hidden">
                            <span class="relative z-10 flex items-center gap-2">
                                Browse Characters
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        
                        <a href="{{ route('favorites.index') }}" 
                           class="group px-8 py-4 bg-slate-800/50 backdrop-blur-sm border-2 border-slate-700 hover:border-emerald-500/50 rounded-xl font-bold text-white hover:text-emerald-400 transition-all duration-300 hover:scale-105 flex items-center gap-2">
                            View Favorites
                            <svg class="w-5 h-5 text-emerald-400 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 
                                5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 
                                2.09A6.48 6.48 0 0 1 16.5 3C19.58 3 
                                22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 
                                11.54L12 21.35z"/>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Stats Bar -->
                    <div class="flex flex-wrap gap-8 pt-8 border-t border-slate-700/50">
                        <div>
                            <div class="text-3xl font-bold text-emerald-400">826+</div>
                            <div class="text-sm text-slate-400 mt-1">Characters</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-pink-400">∞</div>
                            <div class="text-sm text-slate-400 mt-1">Favorites</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-blue-400">51+</div>
                            <div class="text-sm text-slate-400 mt-1">Episodes</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Visual -->
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-cyan-500/20 rounded-3xl blur-3xl"></div>
                    <div class="relative rounded-3xl overflow-hidden border border-slate-700/50 backdrop-blur-sm bg-slate-900/30 p-8 hover:scale-105 transition-transform duration-500">
                        <img src="https://rickandmortyapi.com/api/character/avatar/2.jpeg" 
                             alt="Morty" 
                             class="w-full rounded-2xl shadow-2xl">
                        <div class="absolute top-12 right-12 w-24 h-24 bg-gradient-to-br from-emerald-400 to-cyan-400 rounded-full blur-2xl opacity-50 animate-pulse"></div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Featured Characters -->
        <div class="py-20">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-2">Featured Characters</h2>
                    <p class="text-slate-400">Meet some of the most iconic beings in the multiverse</p>
                </div>
                <a href="{{ route('characters.index') }}" 
                   class="hidden sm:flex items-center gap-2 text-emerald-400 hover:text-emerald-300 font-semibold group">
                    View All
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($characters ?? [] as $character)
                <a href="{{ route('characters.show', $character['id']) }}" 
                   class="group relative rounded-2xl overflow-hidden bg-slate-900/50 backdrop-blur-sm border border-slate-700/50 hover:border-emerald-500/50 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-emerald-500/20">
                    
                    <div class="relative h-72 overflow-hidden">
                        <img src="{{ $character['image'] }}" 
                             alt="{{ $character['name'] }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"></div>
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold backdrop-blur-md
                                {{ $character['status'] === 'Alive' ? 'bg-emerald-500/80 text-white' : '' }}
                                {{ $character['status'] === 'Dead' ? 'bg-red-500/80 text-white' : '' }}
                                {{ $character['status'] === 'unknown' ? 'bg-slate-500/80 text-white' : '' }}">
                                {{ $character['status'] }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-5 space-y-2">
                        <h3 class="text-xl font-bold text-white group-hover:text-emerald-400 transition-colors">
                            {{ $character['name'] }}
                        </h3>
                        <p class="text-slate-400 text-sm">{{ $character['species'] }}</p>
                        <div class="flex items-center gap-2 text-slate-500 text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <span class="truncate">{{ $character['location']['name'] }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="py-20">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-4 text-center">Start Your Journey</h2>
            <p class="text-slate-400 text-center mb-12 max-w-2xl mx-auto">Choose your path through the infinite dimensions</p>
            
            <div class="grid md:grid-cols-3 gap-6">
                
                <!-- Characters Card -->
                <a href="{{ route('characters.index') }}" 
                   class="group relative rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-900/50 to-slate-900/50 border border-emerald-500/30 hover:border-emerald-500 backdrop-blur-sm p-8 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-emerald-500/20">
                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-emerald-500 to-cyan-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors">
                            Browse Characters
                        </h3>
                        <p class="text-slate-300 mb-4">
                            Discover 826+ unique characters from across infinite realities, each with their own stories and dimensions.
                        </p>
                        <div class="flex items-center gap-2 text-emerald-400 font-semibold">
                            Explore now
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>

                <!-- Favorites Card -->
                <a href="{{ route('favorites.index') }}" 
                   class="group relative rounded-2xl overflow-hidden bg-gradient-to-br from-pink-900/50 to-slate-900/50 border border-pink-500/30 hover:border-pink-500 backdrop-blur-sm p-8 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-pink-500/20">
                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 
                                5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 
                                2.09A6.48 6.48 0 0 1 16.5 3C19.58 3 
                                22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 
                                11.54L12 21.35z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-pink-400 transition-colors">
                            View Favorites
                        </h3>
                        <p class="text-slate-300 mb-4">
                            See all the characters you’ve saved and follow your interdimensional companions anytime.
                        </p>
                        <div class="flex items-center gap-2 text-pink-400 font-semibold">
                            Open favorites
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>

                <!-- Episodes Card -->
                <a href="{{ route('episodes.index') }}" 
                   class="group relative rounded-2xl overflow-hidden bg-gradient-to-br from-blue-900/50 to-slate-900/50 border border-blue-500/30 hover:border-blue-500 backdrop-blur-sm p-8 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/20">
                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-blue-400 transition-colors">
                            Watch Episodes
                        </h3>
                        <p class="text-slate-300 mb-4">
                            Relive all 51 epic episodes filled with interdimensional adventures and chaotic fun.
                        </p>
                        <div class="flex items-center gap-2 text-blue-400 font-semibold">
                            View episodes
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
                
            </div>
        </div>

    </div>
</div>
@endsection

@section('styles')
<style>
@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
.animate-gradient { background-size: 200% 200%; animation: gradient 3s ease infinite; }

.particles-container { position: absolute; width: 100%; height: 100%; overflow: hidden; }
.particle { position: absolute; width: 2px; height: 2px; background: rgba(16, 185, 129, 0.5); border-radius: 50%; left: var(--x); top: var(--y); animation: float var(--duration) ease-in-out infinite; animation-delay: var(--delay); }
@keyframes float { 0%, 100% { transform: translate(0,0); opacity:0; } 10%,90% { opacity:1; } 50% { transform: translate(50px,-100px); } }

.grid-overlay { position:absolute; inset:0; background-image:linear-gradient(rgba(16,185,129,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(16,185,129,0.03) 1px,transparent 1px); background-size:50px 50px; }

html { scroll-behavior:smooth; }
::-webkit-scrollbar { width:10px; }
::-webkit-scrollbar-track { background:#0f172a; }
::-webkit-scrollbar-thumb { background:linear-gradient(to bottom,#10b981,#06b6d4); border-radius:5px; }
::-webkit-scrollbar-thumb:hover { background:linear-gradient(to bottom,#059669,#0891b2); }
</style>
@endsection
