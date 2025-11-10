@extends('layouts.app')

@section('title', 'Characters - Multiverse Explorer')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-900 text-white">
    
    <!-- Ambient Background -->
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-20 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-4xl lg:text-5xl font-black mb-3">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400">
                            Characters
                        </span>
                    </h1>
                    @if($name)
                        <p class="text-slate-400 text-lg flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search results for <span class="text-white font-semibold">"{{ $name }}"</span>
                        </p>
                    @else
                        <p class="text-slate-400 text-lg">Explore 826+ characters across infinite dimensions</p>
                    @endif
                </div>

                <!-- Search Form -->
                <div class="relative">
                    <form action="{{ route('characters.index') }}" method="GET" class="flex gap-2">
                        <div class="relative">
                            <input type="text" 
                                   name="name" 
                                   value="{{ $name ?? '' }}"
                                   placeholder="Search characters..." 
                                   class="w-full md:w-80 px-4 py-3 pl-11 bg-slate-800/50 backdrop-blur-sm border border-slate-700 focus:border-emerald-500/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl font-bold text-slate-900 hover:shadow-lg hover:shadow-emerald-500/50 transition-all hover:scale-105">
                            Search
                        </button>
                        @if($name)
                            <a href="{{ route('characters.index') }}" 
                               class="px-4 py-3 bg-slate-800/50 backdrop-blur-sm border border-slate-700 hover:border-red-500/50 rounded-xl text-slate-300 hover:text-red-400 transition-all flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Stats Bar -->
            @if($data)
            <div class="mt-6 flex flex-wrap items-center gap-4 text-sm text-slate-400">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                    <span>Page {{ $page ?? 1 }} of {{ $data['info']['pages'] }}</span>
                </div>
                <div class="w-px h-4 bg-slate-700"></div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span>{{ $data['info']['count'] }} characters found</span>
                </div>
            </div>
            @endif
        </div>

        @if(!$data)
            <!-- Error State -->
            <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-red-900/20 to-slate-900/50 border border-red-500/30 backdrop-blur-sm p-8 text-center">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-500/20 to-transparent rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-white mb-2">Unable to Load Characters</h3>
                    <p class="text-slate-400 mb-6">We couldn't fetch the character data. Please try again later.</p>
                    <button onclick="window.location.reload()" 
                            class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl font-bold text-slate-900 hover:shadow-lg hover:shadow-emerald-500/50 transition-all hover:scale-105">
                        Try Again
                    </button>
                </div>
            </div>
        @else
            <!-- Characters Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($data['results'] as $char)
                <div class="group relative rounded-2xl overflow-hidden bg-slate-900/50 backdrop-blur-sm border border-slate-700/50 hover:border-emerald-500/50 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-emerald-500/20">
                    
                    <!-- Character Image -->
                    <div class="relative h-80 overflow-hidden">
                        <img src="{{ $char['image'] }}" 
                             alt="{{ $char['name'] }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"></div>
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold backdrop-blur-md flex items-center gap-1.5
                                @if($char['status'] === 'Alive') bg-emerald-500/80 text-white
                                @elseif($char['status'] === 'Dead') bg-red-500/80 text-white
                                @else bg-slate-500/80 text-white
                                @endif">
                                <span class="w-1.5 h-1.5 rounded-full bg-white {{ $char['status'] === 'Alive' ? 'animate-pulse' : '' }}"></span>
                                {{ $char['status'] }}
                            </span>
                        </div>

                        <!-- Favorite Button -->
                        @auth
                        <div class="absolute top-4 right-4">
                            <!-- data attributes added; SVG markup left intact.
                                 initial filled state set server-side using $favorites (array of ids) -->
                            <button onclick="toggleFavorite({{ $char['id'] }})" 
                                    class="favorite-btn group/fav w-10 h-10 rounded-full bg-slate-900/80 backdrop-blur-md border border-slate-700 hover:border-pink-500 flex items-center justify-center transition-all hover:scale-110"
                                    data-character-id="{{ $char['id'] }}"
                                    data-character-name="{{ e($char['name']) }}"
                                    data-character-image="{{ $char['image'] }}">
                                <svg class="w-5 h-5 transition-colors {{ in_array($char['id'], $favorites ?? []) ? 'text-pink-500' : 'text-slate-400' }}" 
                                     fill="{{ in_array($char['id'], $favorites ?? []) ? 'currentColor' : 'none' }}" 
                                     stroke="currentColor" 
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </div>
                        @endauth

                        <!-- Species Badge -->
                        <div class="absolute bottom-4 left-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-cyan-500/20 border border-cyan-500/30 text-cyan-300 backdrop-blur-md">
                                {{ $char['species'] }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Character Info -->
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-white group-hover:text-emerald-400 transition-colors mb-2">
                            {{ $char['name'] }}
                        </h3>
                        
                        <div class="flex items-center gap-2 text-slate-500 text-xs mb-4">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <span class="truncate">{{ $char['location']['name'] ?? 'Unknown' }}</span>
                        </div>

                        <a href="{{ route('characters.show', $char['id']) }}" 
                           class="flex items-center justify-between w-full px-4 py-2 bg-slate-800/50 hover:bg-slate-800 border border-slate-700 hover:border-emerald-500/50 rounded-lg text-slate-300 hover:text-emerald-400 text-sm font-semibold transition-all group/link">
                            <span>View Details</span>
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @php
                $info = $data['info'];
                $current = (int)($page ?? 1);
                $totalPages = $info['pages'];
            @endphp

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 py-8">
                <!-- Page Info -->
                <div class="text-slate-400 text-sm">
                    Showing page <span class="text-white font-semibold">{{ $current }}</span> of <span class="text-white font-semibold">{{ $totalPages }}</span>
                </div>

                <!-- Pagination Buttons -->
                <nav class="flex items-center gap-2">
                    <!-- Previous Button -->
                    <a href="{{ route('characters.index', ['page' => max(1, $current-1), 'name' => $name]) }}" 
                       class="px-4 py-2 bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-lg text-slate-300 hover:text-emerald-400 hover:border-emerald-500/50 transition-all {{ $current <= 1 ? 'opacity-50 pointer-events-none' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>

                    <!-- Page Numbers -->
                    <div class="hidden sm:flex items-center gap-2">
                        @for($i = max(1, $current - 2); $i <= min($totalPages, $current + 2); $i++)
                            <a href="{{ route('characters.index', ['page' => $i, 'name' => $name]) }}" 
                               class="w-10 h-10 flex items-center justify-center rounded-lg font-semibold transition-all
                                   {{ $i == $current 
                                       ? 'bg-gradient-to-r from-emerald-500 to-cyan-500 text-slate-900' 
                                       : 'bg-slate-800/50 border border-slate-700 text-slate-300 hover:border-emerald-500/50 hover:text-emerald-400' }}">
                                {{ $i }}
                            </a>
                        @endfor
                    </div>

                    <!-- Mobile Page Display -->
                    <div class="sm:hidden px-4 py-2 bg-gradient-to-r from-emerald-500/20 to-cyan-500/20 border border-emerald-500/30 rounded-lg text-emerald-400 font-semibold">
                        {{ $current }} / {{ $totalPages }}
                    </div>

                    <!-- Next Button -->
                    <a href="{{ route('characters.index', ['page' => min($totalPages, $current+1), 'name' => $name]) }}" 
                       class="px-4 py-2 bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-lg text-slate-300 hover:text-emerald-400 hover:border-emerald-500/50 transition-all {{ $current >= $totalPages ? 'opacity-50 pointer-events-none' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </nav>

                <!-- Jump to Page -->
                <form action="{{ route('characters.index') }}" method="GET" class="flex items-center gap-2">
                    @if($name)
                        <input type="hidden" name="name" value="{{ $name }}">
                    @endif
                    <label class="text-slate-400 text-sm whitespace-nowrap">Jump to:</label>
                    <input type="number" 
                           name="page" 
                           min="1" 
                           max="{{ $totalPages }}" 
                           value="{{ $current }}"
                           class="w-20 px-3 py-2 bg-slate-800/50 backdrop-blur-sm border border-slate-700 focus:border-emerald-500/50 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    <button type="submit" 
                            class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-lg font-semibold text-slate-900 text-sm hover:shadow-lg hover:shadow-emerald-500/50 transition-all hover:scale-105">
                        Go
                    </button>
                </form>
            </div>
        @endif

    </div>
</div>

@auth
<script>
async function toggleFavorite(characterId) {
    const btn = document.querySelector(`.favorite-btn[data-character-id="${characterId}"]`);
    if (!btn) return;

    // Prevent double clicks
    if (btn.disabled) return;
    btn.disabled = true;

    const svg = btn.querySelector('svg');
    if (!svg) { btn.disabled = false; return; }

    // Read name & image from data attributes (reliable)
    const name = btn.getAttribute('data-character-name') || '';
    const image = btn.getAttribute('data-character-image') || '';

    // Determine previous state (do not change SVG structure)
    const wasFavorited = svg.getAttribute('fill') === 'currentColor' || svg.classList.contains('text-pink-500');

    // Optimistic UI flip (visual only)
    if (wasFavorited) {
        svg.classList.remove('text-pink-500');
        svg.classList.add('text-slate-400');
        svg.setAttribute('fill', 'none');
    } else {
        svg.classList.remove('text-slate-400');
        svg.classList.add('text-pink-500');
        svg.setAttribute('fill', 'currentColor');
    }

    try {
        const res = await fetch('{{ route("favorites.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                character_id: characterId,
                character_name: name,
                character_image: image
            })
        });

        const data = await res.json().catch(() => ({}));

        if (!res.ok) {
            throw new Error(data.message || 'Server error');
        }

        // Reconcile UI with server response
        if (data.status === 'added') {
            svg.classList.remove('text-slate-400');
            svg.classList.add('text-pink-500');
            svg.setAttribute('fill', 'currentColor');
        } else if (data.status === 'removed') {
            svg.classList.remove('text-pink-500');
            svg.classList.add('text-slate-400');
            svg.setAttribute('fill', 'none');
        }

        // Update favorites-count if present on the page
        if (typeof data.favorites_count !== 'undefined') {
            const countEl = document.getElementById('favorites-count');
            if (countEl) countEl.textContent = data.favorites_count;
        }

    } catch (err) {
        console.error('Error toggling favorite:', err);

        // Revert optimistic UI on error
        if (wasFavorited) {
            svg.classList.remove('text-slate-400');
            svg.classList.add('text-pink-500');
            svg.setAttribute('fill', 'currentColor');
        } else {
            svg.classList.remove('text-pink-500');
            svg.classList.add('text-slate-400');
            svg.setAttribute('fill', 'none');
        }

        // small feedback
        btn.style.transform = 'translateY(-3px)';
        setTimeout(() => { btn.style.transform = ''; }, 180);
    } finally {
        btn.disabled = false;
    }
}

// delegate (ensures clicking inner svg or button works)
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.favorite-btn');
    if (!btn) return;
    const id = btn.getAttribute('data-character-id');
    if (!id) return;
    e.preventDefault();
    toggleFavorite(id);
});
</script>
@endauth


@section('styles')
<style>
/* Custom scrollbar */
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
@endsection
