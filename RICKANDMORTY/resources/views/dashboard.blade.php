@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Ensure Tailwind classes work - Add this temporarily */
    .w-6 { width: 1.5rem !important; }
    .h-6 { height: 1.5rem !important; }
    .w-5 { width: 1.25rem !important; }
    .h-5 { height: 1.25rem !important; }
    .w-4 { width: 1rem !important; }
    .h-4 { height: 1rem !important; }
    .w-2 { width: 0.5rem !important; }
    .h-2 { height: 0.5rem !important; }
    
    /* Fix any conflicting styles */
    svg { display: inline-block; }
    .btn-disabled { pointer-events: none; opacity: .6; }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-900 text-white">
    
    <!-- Ambient Background -->
    <div style="position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none;">
        <div style="position: absolute; top: 5rem; left: 5rem; width: 24rem; height: 24rem; background: rgba(16, 185, 129, 0.1); border-radius: 9999px; filter: blur(80px); animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;"></div>
        <div style="position: absolute; bottom: 5rem; right: 5rem; width: 24rem; height: 24rem; background: rgba(6, 182, 212, 0.1); border-radius: 9999px; filter: blur(80px); animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; animation-delay: 1s;"></div>
    </div>

    <div style="position: relative; z-index: 10; max-width: 1280px; margin: 0 auto; padding: 2rem 1rem;">
        
        <!-- Welcome Header -->
        <div style="margin-bottom: 2.5rem;">
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div>
                    <h1 style="font-size: 3rem; font-weight: 900; margin-bottom: 0.5rem;">
                        <span style="background: linear-gradient(to right, #34d399, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Welcome back,
                        </span>
                        <span style="display: block; margin-top: 0.25rem; color: white;">{{ Auth::user()->name }}</span>
                    </h1>
                    <p style="color: #94a3b8; font-size: 1.125rem; display: flex; align-items: center; gap: 0.5rem;">
                        <span style="width: 0.5rem; height: 0.5rem; background: #34d399; border-radius: 9999px; animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;"></span>
                        Your multiverse control center
                    </p>
                </div>
                
                <!-- Quick Actions -->
                <div style="display: flex; gap: 0.75rem; margin-top: 1rem;">
                    <a href="{{ route('characters.index') }}" 
                       style="padding: 0.75rem 1.5rem; background: linear-gradient(to right, #10b981, #06b6d4); border-radius: 0.75rem; font-weight: bold; color: #0f172a; text-decoration: none; transition: all 0.3s; display: inline-block;">
                        Explore Now
                    </a>
                    <a href="{{ route('profile.edit') }}" 
                       style="padding: 0.75rem; background: rgba(30, 41, 59, 0.5); backdrop-filter: blur(12px); border: 1px solid #334155; border-radius: 0.75rem; transition: all 0.3s; display: inline-flex; align-items: center; text-decoration: none;">
                        <svg style="width: 1.5rem; height: 1.5rem; color: #cbd5e1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Dashboard -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
            
            <!-- Total Characters -->
            <div style="position: relative; border-radius: 1rem; overflow: hidden; background: linear-gradient(to bottom right, rgba(6, 78, 59, 0.3), rgba(15, 23, 42, 0.5)); border: 1px solid rgba(16, 185, 129, 0.3); backdrop-filter: blur(12px); padding: 1.5rem; transition: all 0.3s;">
                <div style="position: relative; z-index: 10;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                        <div style="padding: 0.75rem; background: rgba(16, 185, 129, 0.2); border-radius: 0.75rem;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: #34d399;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span style="font-size: 0.75rem; color: #34d399; font-weight: 600; padding: 0.25rem 0.5rem; background: rgba(16, 185, 129, 0.2); border-radius: 9999px;">TOTAL</span>
                    </div>
                    <div>
                        <p style="font-size: 3rem; font-weight: 900; color: white; margin-bottom: 0.25rem;">{{ $stats['characters'] }}</p>
                        <p style="color: #94a3b8; font-size: 0.875rem; font-weight: 500;">Characters</p>
                    </div>
                </div>
            </div>

            <!-- Total Locations -->
            <div style="position: relative; border-radius: 1rem; overflow: hidden; background: linear-gradient(to bottom right, rgba(8, 51, 68, 0.3), rgba(15, 23, 42, 0.5)); border: 1px solid rgba(6, 182, 212, 0.3); backdrop-filter: blur(12px); padding: 1.5rem; transition: all 0.3s;">
                <div style="position: relative; z-index: 10;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                        <div style="padding: 0.75rem; background: rgba(6, 182, 212, 0.2); border-radius: 0.75rem;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: #22d3ee;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span style="font-size: 0.75rem; color: #22d3ee; font-weight: 600; padding: 0.25rem 0.5rem; background: rgba(6, 182, 212, 0.2); border-radius: 9999px;">TOTAL</span>
                    </div>
                    <div>
                        <p style="font-size: 3rem; font-weight: 900; color: white; margin-bottom: 0.25rem;">{{ $stats['locations'] }}</p>
                        <p style="color: #94a3b8; font-size: 0.875rem; font-weight: 500;">Locations</p>
                    </div>
                </div>
            </div>

            <!-- Total Episodes -->
            <div style="position: relative; border-radius: 1rem; overflow: hidden; background: linear-gradient(to bottom right, rgba(30, 58, 138, 0.3), rgba(15, 23, 42, 0.5)); border: 1px solid rgba(59, 130, 246, 0.3); backdrop-filter: blur(12px); padding: 1.5rem; transition: all 0.3s;">
                <div style="position: relative; z-index: 10;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                        <div style="padding: 0.75rem; background: rgba(59, 130, 246, 0.2); border-radius: 0.75rem;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: #60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span style="font-size: 0.75rem; color: #60a5fa; font-weight: 600; padding: 0.25rem 0.5rem; background: rgba(59, 130, 246, 0.2); border-radius: 9999px;">TOTAL</span>
                    </div>
                    <div>
                        <p style="font-size: 3rem; font-weight: 900; color: white; margin-bottom: 0.25rem;">{{ $stats['episodes'] }}</p>
                        <p style="color: #94a3b8; font-size: 0.875rem; font-weight: 500;">Episodes</p>
                    </div>
                </div>
            </div>

            <!-- Favorites Count -->
            <div style="position: relative; border-radius: 1rem; overflow: hidden; background: linear-gradient(to bottom right, rgba(88, 28, 135, 0.3), rgba(15, 23, 42, 0.5)); border: 1px solid rgba(168, 85, 247, 0.3); backdrop-filter: blur(12px); padding: 1.5rem; transition: all 0.3s;">
                <div style="position: relative; z-index: 10;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                        <div style="padding: 0.75rem; background: rgba(168, 85, 247, 0.2); border-radius: 0.75rem;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: #c084fc;" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/>
                            </svg>
                        </div>
                        <span style="font-size: 0.75rem; color: #c084fc; font-weight: 600; padding: 0.25rem 0.5rem; background: rgba(168, 85, 247, 0.2); border-radius: 9999px;">YOUR</span>
                    </div>
                    <div>
                        <p style="font-size: 3rem; font-weight: 900; color: white; margin-bottom: 0.25rem;" id="favorites-count">{{ count($favorites) }}</p>
                        <p style="color: #94a3b8; font-size: 0.875rem; font-weight: 500;">Favorites</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Featured Characters Section -->
        <div style="margin-top: 3rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                <div>
                    <h2 style="font-size: 1.875rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">Featured Characters</h2>
                    <p style="color: #94a3b8; font-size: 0.875rem;">Discover amazing beings from across dimensions</p>
                </div>
                <a href="{{ route('characters.index') }}" 
                   style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: rgba(30, 41, 59, 0.5); backdrop-filter: blur(12px); border: 1px solid #334155; border-radius: 0.75rem; color: #34d399; font-weight: 600; text-decoration: none; transition: all 0.3s;">
                    View All
                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>

            <!-- Characters Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                @foreach($characters as $character)
                <div style="position: relative; border-radius: 1rem; overflow: hidden; background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(12px); border: 1px solid rgba(51, 65, 85, 0.5); transition: all 0.3s;">
                    
                    <!-- Character Image -->
                    <div style="position: relative; height: 16rem; overflow: hidden;">
                        <img src="{{ $character['image'] }}" 
                             alt="{{ $character['name'] }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15, 23, 42, 1), rgba(15, 23, 42, 0.5), transparent);"></div>
                        
                        <!-- Status Badge -->
                        <div style="position: absolute; top: 1rem; left: 1rem;">
                            <span style="padding: 0.5rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: bold; backdrop-filter: blur(12px); display: inline-flex; align-items: center; gap: 0.375rem;
                                @if($character['status'] === 'Alive') background: rgba(16, 185, 129, 0.8); color: white;
                                @elseif($character['status'] === 'Dead') background: rgba(239, 68, 68, 0.8); color: white;
                                @else background: rgba(100, 116, 139, 0.8); color: white;
                                @endif">
                                <span style="width: 0.375rem; height: 0.375rem; border-radius: 9999px; background: white; {{ $character['status'] === 'Alive' ? 'animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;' : '' }}"></span>
                                {{ $character['status'] }}
                            </span>
                        </div>

                        <!-- Favorite Button -->
                        <div style="position: absolute; top: 1rem; right: 1rem;">
                            <button onclick="toggleFavorite({{ $character['id'] }})" 
                                    class="favorite-btn"
                                    data-character-id="{{ $character['id'] }}"
                                    data-character-name="{{ e($character['name']) }}"
                                    data-character-image="{{ $character['image'] }}"
                                    style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); border: 1px solid #334155; display: flex; align-items: center; justify-content: center; transition: all 0.3s; cursor: pointer;">
                                <svg style="width: 1.25rem; height: 1.25rem; color: {{ in_array($character['id'], $favorites) ? '#ec4899' : '#94a3b8' }}; transition: color 0.3s;" 
                                     fill="{{ in_array($character['id'], $favorites) ? 'currentColor' : 'none' }}" 
                                     stroke="currentColor" 
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Character Info -->
                    <div style="padding: 1.25rem;">
                        <div style="margin-bottom: 0.75rem;">
                            <h3 style="font-size: 1.25rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">
                                {{ $character['name'] }}
                            </h3>
                            <p style="color: #94a3b8; font-size: 0.875rem;">{{ $character['species'] }}</p>
                        </div>
                        
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: #64748b; font-size: 0.75rem; margin-bottom: 0.75rem;">
                            <svg style="width: 1rem; height: 1rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $character['location']['name'] }}</span>
                        </div>

                        <a href="{{ route('characters.show', $character['id']) }}" 
                           style="display: flex; align-items: center; justify-between; width: 100%; padding: 0.5rem 1rem; background: rgba(30, 41, 59, 0.5); border: 1px solid #334155; border-radius: 0.5rem; color: #cbd5e1; font-size: 0.875rem; font-weight: 600; transition: all 0.3s; text-decoration: none;">
                            <span>View Details</span>
                            <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                       
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<script>
// Track the current favorites count accurately
let currentFavoritesCount = {{ count($favorites) }};

async function toggleFavorite(characterId) {
    const btn = document.querySelector(`.favorite-btn[data-character-id="${characterId}"]`);
    if (!btn) return;

    // Prevent double clicks
    if (btn.classList.contains('btn-disabled')) return;
    btn.classList.add('btn-disabled');

    const svg = btn.querySelector('svg');
    if (!svg) { 
        btn.classList.remove('btn-disabled'); 
        return; 
    }

    // Read name & image from data attributes
    const name = btn.getAttribute('data-character-name') || '';
    const image = btn.getAttribute('data-character-image') || '';

    // Determine if currently favorited
    const wasFavorited = svg.getAttribute('fill') === 'currentColor';

    // Optimistic UI update
    const previousCount = currentFavoritesCount;
    if (wasFavorited) {
        // Removing from favorites
        svg.style.color = '#94a3b8';
        svg.setAttribute('fill', 'none');
        svg.classList.remove('text-pink-500', 'fill-current');
        currentFavoritesCount--;
    } else {
        // Adding to favorites
        svg.style.color = '#ec4899';
        svg.setAttribute('fill', 'currentColor');
        svg.classList.add('text-pink-500', 'fill-current');
        currentFavoritesCount++;
    }

    // Update count display immediately
    const countEl = document.getElementById('favorites-count');
    if (countEl) {
        countEl.textContent = currentFavoritesCount;
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

        // Sync UI with server response
        if (data.status === 'added') {
            svg.style.color = '#ec4899';
            svg.setAttribute('fill', 'currentColor');
            svg.classList.add('text-pink-500', 'fill-current');
        } else if (data.status === 'removed') {
            svg.style.color = '#94a3b8';
            svg.setAttribute('fill', 'none');
            svg.classList.remove('text-pink-500', 'fill-current');
        }

        // Use server's authoritative count if provided
        if (typeof data.favorites_count !== 'undefined') {
            currentFavoritesCount = data.favorites_count;
            if (countEl) {
                countEl.textContent = currentFavoritesCount;
            }
        }

        // Optional: Show success feedback
        btn.style.transform = 'scale(1.1)';
        setTimeout(() => { 
            btn.style.transform = ''; 
        }, 200);

    } catch (err) {
        console.error('Error toggling favorite:', err);

        // Revert optimistic changes on error
        currentFavoritesCount = previousCount;
        if (countEl) {
            countEl.textContent = currentFavoritesCount;
        }

        if (wasFavorited) {
            svg.style.color = '#ec4899';
            svg.setAttribute('fill', 'currentColor');
            svg.classList.add('text-pink-500', 'fill-current');
        } else {
            svg.style.color = '#94a3b8';
            svg.setAttribute('fill', 'none');
            svg.classList.remove('text-pink-500', 'fill-current');
        }

        // Visual error feedback
        btn.style.transform = 'translateX(-5px)';
        setTimeout(() => { 
            btn.style.transform = 'translateX(5px)'; 
            setTimeout(() => { 
                btn.style.transform = ''; 
            }, 100);
        }, 100);

        // Optional: Show error message
        alert('Failed to update favorite. Please try again.');
    } finally {
        btn.classList.remove('btn-disabled');
    }
}

// Delegated click handler
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.favorite-btn');
    if (!btn) return;

    const id = btn.getAttribute('data-character-id');
    if (!id) return;

    e.preventDefault();
    e.stopPropagation();
    toggleFavorite(id);
});
</script>
@endsection