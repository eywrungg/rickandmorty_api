@extends('layouts.app')

@section('title', 'Episodes — Rick and Morty Universe')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-purple-950 to-slate-900 text-white py-16 px-6">
    <div class="max-w-7xl mx-auto">

        <!-- Hero Header with Floating Elements -->
        <div class="relative mb-16">
            <!-- Floating Portal Effect -->
            <div class="absolute -top-20 right-0 w-96 h-96 bg-emerald-500/20 rounded-full blur-[120px] animate-pulse-slow"></div>
            <div class="absolute -top-10 left-20 w-64 h-64 bg-cyan-500/20 rounded-full blur-[100px] animate-pulse-slow" style="animation-delay: 1s;"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-400/30 backdrop-blur-sm mb-4">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-ping"></span>
                    <span class="text-emerald-300 text-sm font-medium">Streaming from Dimension C-137</span>
                </div>
                
                <h1 class="text-6xl md:text-7xl font-black mb-4">
                    <span class="bg-gradient-to-r from-emerald-400 via-cyan-400 to-purple-500 bg-clip-text text-transparent animate-gradient">
                        Interdimensional
                    </span>
                    <br/>
                    <span class="text-white">Episode Archive</span>
                </h1>
                <p class="text-slate-400 text-xl max-w-2xl">
                    Browse through infinite timelines of chaotic adventures, one episode at a time.
                </p>
            </div>
        </div>

        <!-- Advanced Search & Filter Bar -->
        <div class="relative mb-12">
            <form method="GET" action="{{ route('episodes.index') }}" class="backdrop-blur-xl bg-slate-900/40 border border-slate-700/50 rounded-2xl p-6 shadow-2xl">
                <div class="grid md:grid-cols-12 gap-4">
                    
                    <!-- Search Input -->
                    <div class="md:col-span-5 relative group">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400 group-focus-within:text-emerald-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="name" 
                            placeholder="Search episode name..." 
                            value="{{ request('name') }}"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all"
                        />
                    </div>

                    <!-- Season Filter -->
                    <div class="md:col-span-3">
                        <select 
                            name="season" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition-all cursor-pointer appearance-none bg-no-repeat bg-right pr-10"
                            style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke=%22%239ca3af%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%222%22 d=%22M19 9l-7 7-7-7%22/%3E%3C/svg%3E'); background-size: 1.5em; background-position: right 0.5rem center;"
                        >
                            <option value="">All Seasons</option>
                            <option value="01" {{ request('season') == '01' ? 'selected' : '' }}>Season 1</option>
                            <option value="02" {{ request('season') == '02' ? 'selected' : '' }}>Season 2</option>
                            <option value="03" {{ request('season') == '03' ? 'selected' : '' }}>Season 3</option>
                            <option value="04" {{ request('season') == '04' ? 'selected' : '' }}>Season 4</option>
                            <option value="05" {{ request('season') == '05' ? 'selected' : '' }}>Season 5</option>
                            <option value="06" {{ request('season') == '06' ? 'selected' : '' }}>Season 6</option>
                            <option value="07" {{ request('season') == '07' ? 'selected' : '' }}>Season 7</option>
                        </select>
                    </div>

                    <!-- Episode Filter -->
                    <div class="md:col-span-2">
                        <input 
                            type="text" 
                            name="episode_num" 
                            placeholder="Episode #" 
                            value="{{ request('episode_num') }}"
                            maxlength="2"
                            class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition-all"
                        />
                    </div>

                    <!-- Action Buttons -->
                    <div class="md:col-span-2 flex gap-2">
                        <button 
                            type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl text-slate-900 font-bold hover:shadow-lg hover:shadow-emerald-500/50 hover:scale-105 transition-all duration-300"
                        >
                            Search
                        </button>
                        <a 
                            href="{{ route('episodes.index') }}"
                            class="px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-slate-400 hover:text-emerald-400 hover:border-emerald-400/50 transition-all duration-300 flex items-center justify-center"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Season Chips -->
                <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-slate-700/50">
                    <span class="text-slate-400 text-sm mr-2">Quick select:</span>
                    @for($i = 1; $i <= 7; $i++)
                        @php $seasonNum = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                        <a 
                            href="?season={{ $seasonNum }}" 
                            class="px-3 py-1 text-xs font-semibold rounded-full transition-all duration-300
                                {{ request('season') == $seasonNum ? 'bg-emerald-500/30 text-emerald-300 border border-emerald-400/50' : 'bg-slate-800/50 text-slate-400 border border-slate-700 hover:border-emerald-400/30 hover:text-emerald-300' }}"
                        >
                            S{{ $i }}
                        </a>
                    @endfor
                </div>
            </form>
        </div>

        <!-- Results Count -->
        @if(request('name') || request('season') || request('episode_num'))
        <div class="mb-6 flex items-center gap-2">
            <div class="h-1 w-1 bg-emerald-400 rounded-full"></div>
            <p class="text-slate-400">
                Found <span class="text-emerald-400 font-semibold">{{ count($episodes) }}</span> episodes
                @if(request('season'))
                    in <span class="text-cyan-400">Season {{ ltrim(request('season'), '0') }}</span>
                @endif
            </p>
        </div>
        @endif

        <!-- Episodes Grid with Staggered Animation -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($episodes as $index => $ep)
            <div 
                class="relative group rounded-2xl overflow-hidden border border-slate-700/40 bg-gradient-to-br from-slate-900/80 to-slate-800/50 backdrop-blur-md shadow-2xl transition-all duration-500 hover:scale-[1.02] hover:border-emerald-400/50 hover:-translate-y-1"
                style="animation: fadeInUp 0.6s ease-out {{ $index * 0.1 }}s both;"
            >
                <!-- Hover Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/0 via-cyan-500/0 to-purple-500/0 group-hover:from-emerald-500/10 group-hover:via-cyan-500/10 group-hover:to-purple-500/10 transition-all duration-500"></div>
                
                <!-- Shimmer Effect -->
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                    <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/5 to-transparent"></div>
                </div>

                <!-- Card Content -->
                <div class="relative p-6 h-full flex flex-col">
                    <!-- Episode Badge & Date -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1.5 text-xs font-bold rounded-full bg-gradient-to-r from-emerald-500/20 to-cyan-500/20 text-emerald-300 border border-emerald-400/30 backdrop-blur-sm">
                            {{ $ep['episode'] }}
                        </span>
                        <div class="flex items-center gap-1.5 text-slate-400 text-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $ep['air_date'] }}
                        </div>
                    </div>

                    <!-- Episode Title -->
                    <h2 class="text-xl font-bold text-white mb-3 line-clamp-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-emerald-400 group-hover:to-cyan-400 group-hover:bg-clip-text transition-all duration-300">
                        {{ $ep['name'] }}
                    </h2>

                    <!-- Spacer -->
                    <div class="flex-grow"></div>

                    <!-- Action Button -->
                    <a 
                        href="{{ route('episodes.show', $ep['id']) }}"
                        class="mt-4 w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800/50 border border-slate-700 text-slate-300 font-semibold group-hover:bg-gradient-to-r group-hover:from-emerald-500/20 group-hover:to-cyan-500/20 group-hover:border-emerald-400/50 group-hover:text-emerald-300 transition-all duration-300"
                    >
                        <span>View Episode</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>

                <!-- Corner Accent -->
                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>
            @endforeach
        </div>

        @if(count($episodes) == 0)
        <div class="text-center py-20">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-800/50 border border-slate-700 mb-6">
                <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-300 mb-2">No Episodes Found</h3>
            <p class="text-slate-400 mb-6">Try adjusting your search filters</p>
            <a href="{{ route('episodes.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl text-slate-900 font-bold hover:shadow-lg hover:shadow-emerald-500/50 transition-all">
                Clear Filters
            </a>
        </div>
        @endif

        <!-- Enhanced Pagination -->
        @if(count($episodes) > 0)
        <div class="flex items-center justify-center gap-3 mt-16">
            @if($info['prev'])
                <a 
                    href="?page={{ request('page', 1) - 1 }}{{ request('name') ? '&name='.request('name') : '' }}{{ request('season') ? '&season='.request('season') : '' }}{{ request('episode_num') ? '&episode_num='.request('episode_num') : '' }}"
                    class="group px-6 py-3 bg-slate-800/60 border border-slate-700 rounded-xl text-slate-300 font-semibold hover:bg-slate-700 hover:border-emerald-400/50 hover:text-emerald-400 transition-all duration-300 flex items-center gap-2"
                >
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Previous
                </a>
            @endif

            <!-- Page Indicator -->
            <div class="px-6 py-3 bg-gradient-to-r from-emerald-500/20 to-cyan-500/20 border border-emerald-400/30 rounded-xl backdrop-blur-sm">
                <span class="text-emerald-300 font-bold">Page {{ request('page', 1) }}</span>
            </div>

            @if($info['next'])
                <a 
                    href="?page={{ request('page', 1) + 1 }}{{ request('name') ? '&name='.request('name') : '' }}{{ request('season') ? '&season='.request('season') : '' }}{{ request('episode_num') ? '&episode_num='.request('episode_num') : '' }}"
                    class="group px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl text-slate-900 font-bold hover:shadow-2xl hover:shadow-emerald-500/30 hover:scale-105 transition-all duration-300 flex items-center gap-2"
                >
                    Next
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse-slow {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.6; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 4s ease infinite;
}

.animate-pulse-slow {
    animation: pulse-slow 4s ease-in-out infinite;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #0f172a;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #10b981, #06b6d4);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #059669, #0891b2);
}
</style>
@endsection