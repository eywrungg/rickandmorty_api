@extends('layouts.app')

@section('title', 'My Favorites')

@section('content')
<div class="min-h-screen bg-[#0A0E27] relative">
    <!-- Subtle Grid Background -->
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    
    <!-- Gradient Orbs -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#44FF44]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#00B5CC]/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 py-12 relative z-10">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div>
                    <h1 class="text-5xl font-['Orbitron'] font-black text-white mb-3 tracking-tight">
                        Favorites
                    </h1>
                    <p class="text-gray-400 text-lg">
                        Your curated collection of characters
                    </p>
                </div>
                
                @if(!$favorites->isEmpty())
                <div class="flex items-center gap-4">
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="text-3xl font-bold text-white">{{ count($favorites) }}</p>
                                <p class="text-sm text-gray-400">Saved</p>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#44FF44] to-[#00B5CC] flex items-center justify-center">
                                <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($favorites->isEmpty())
            <!-- Empty State -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-16 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-[#44FF44]/20 to-[#00B5CC]/20 mb-8">
                        <svg class="w-12 h-12 text-[#44FF44]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-white mb-4">No favorites yet</h2>
                    <p class="text-gray-400 mb-8 text-lg max-w-md mx-auto">
                        Start building your collection by exploring characters and marking your favorites
                    </p>
                    
                    <a href="{{ route('characters.index') }}" 
                       class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-[#44FF44] to-[#00B5CC] text-black font-semibold rounded-xl hover:shadow-2xl hover:shadow-[#44FF44]/20 transition-all transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Explore Characters
                    </a>
                </div>
            </div>
        @else
            <!-- Favorites Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($favorites as $fav)
                <div class="character-card group">
                    <div class="relative overflow-hidden rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-[#44FF44]/40 transition-all duration-500">
                        <!-- Image Section -->
                        <div class="relative aspect-square overflow-hidden">
                            <img src="{{ $fav['image'] }}" 
                                 alt="{{ $fav['name'] }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            
                            <!-- Status Badge -->
                            <div class="absolute top-4 right-4">
                                @if($fav['status'] === 'Alive')
                                    <div class="px-3 py-1.5 bg-emerald-500/90 backdrop-blur-sm rounded-full flex items-center gap-2">
                                        <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                        <span class="text-white text-xs font-medium">Alive</span>
                                    </div>
                                @elseif($fav['status'] === 'Dead')
                                    <div class="px-3 py-1.5 bg-red-500/90 backdrop-blur-sm rounded-full flex items-center gap-2">
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                        <span class="text-white text-xs font-medium">Dead</span>
                                    </div>
                                @else
                                    <div class="px-3 py-1.5 bg-gray-500/90 backdrop-blur-sm rounded-full flex items-center gap-2">
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                        <span class="text-white text-xs font-medium">Unknown</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Favorite Button -->
                            <button onclick="toggleFavorite({{ $fav['id'] }})" 
                                    class="absolute top-4 left-4 w-10 h-10 bg-red-500/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-red-600 transition-all hover:scale-110 active:scale-95">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                            </button>

                            <!-- Name Overlay -->
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-2xl font-bold text-white mb-1">{{ $fav['name'] }}</h3>
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400 text-sm">Species</span>
                                <span class="text-white font-medium">{{ $fav['species'] }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400 text-sm">Gender</span>
                                <span class="text-white font-medium">{{ $fav['gender'] }}</span>
                            </div>
                            
                            <div class="flex items-start justify-between py-2">
                                <span class="text-gray-400 text-sm">Location</span>
                                <span class="text-white font-medium text-right max-w-[180px] truncate">{{ $fav['location'] }}</span>
                            </div>

                            <!-- View Button -->
                            <a href="{{ route('characters.show', $fav['id']) }}" 
                               class="mt-4 block w-full py-3 px-4 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-[#44FF44]/40 rounded-xl text-center text-white font-medium transition-all group-hover:bg-gradient-to-r group-hover:from-[#44FF44]/10 group-hover:to-[#00B5CC]/10">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Bottom Action -->
            <div class="mt-16 text-center">
                <a href="{{ route('characters.index') }}" 
                   class="inline-flex items-center gap-3 px-6 py-3 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-[#44FF44]/40 rounded-xl text-white font-medium transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add More Characters
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .bg-grid-pattern {
        background-image: 
            linear-gradient(rgba(68, 255, 68, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(68, 255, 68, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
    }

    .character-card {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .character-card:nth-child(1) { animation-delay: 0.1s; }
    .character-card:nth-child(2) { animation-delay: 0.2s; }
    .character-card:nth-child(3) { animation-delay: 0.3s; }
    .character-card:nth-child(4) { animation-delay: 0.4s; }
    .character-card:nth-child(5) { animation-delay: 0.5s; }
    .character-card:nth-child(6) { animation-delay: 0.6s; }
    .character-card:nth-child(7) { animation-delay: 0.7s; }
    .character-card:nth-child(8) { animation-delay: 0.8s; }

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

    .character-card:hover {
        transform: translateY(-8px);
    }
</style>

<script>
async function toggleFavorite(characterId) {
    try {
        const response = await fetch("{{ route('favorites.toggle') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || "{{ csrf_token() }}"
            },
            body: JSON.stringify({ character_id: characterId })
        });

        const data = await response.json();
        
        if (data.success) {
            window.location.reload();
        } else {
            console.error('Failed to update favorite');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}
</script>
@endsection