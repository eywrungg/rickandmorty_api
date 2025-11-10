@extends('layouts.app')

@section('title', $character['name'] . ' — Character Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-900 text-white py-16 px-4 sm:px-8">
    <div class="max-w-6xl mx-auto relative">

        <!-- Character Card -->
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <!-- Left: Image -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-cyan-500/20 rounded-3xl blur-2xl"></div>
                <div class="relative rounded-3xl overflow-hidden border border-slate-700/50 bg-slate-900/40 backdrop-blur-md p-6 hover:scale-105 transition-transform duration-500">
                    <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}" class="rounded-2xl shadow-2xl w-full">
                </div>
            </div>

            <!-- Right: Details -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-5xl font-black mb-3 text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-500 animate-gradient">
                        {{ $character['name'] }}
                    </h1>
                    <p class="text-slate-300 text-lg">
                        <span class="font-semibold text-emerald-400">{{ $character['status'] }}</span> •
                        {{ $character['species'] }} • {{ $character['gender'] }}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="rounded-xl border border-slate-700/50 bg-slate-800/40 p-4">
                        <p class="text-slate-400 text-sm">Origin</p>
                        <p class="text-lg font-semibold text-white">{{ $character['origin']['name'] }}</p>
                    </div>
                    <div class="rounded-xl border border-slate-700/50 bg-slate-800/40 p-4">
                        <p class="text-slate-400 text-sm">Current Location</p>
                        <p class="text-lg font-semibold text-white">{{ $character['location']['name'] }}</p>
                    </div>
                </div>

                <div class="pt-4">
                    @auth
                        @php
                            // Determine initial favorite state from $favorites passed by controller
                            $isFavorited = in_array($character['id'], $favorites ?? []);
                            $btnGradientClass = $isFavorited ? 'from-red-500 to-pink-500' : 'from-emerald-500 to-cyan-500';
                            $btnText = $isFavorited ? '♥ Remove from Favorites' : '★ Add to Favorites';
                        @endphp

                        <button
                            id="favoriteBtn"
                            class="group relative px-8 py-4 bg-gradient-to-r {{ $btnGradientClass }} rounded-xl font-bold text-slate-900 shadow-xl shadow-emerald-500/25 hover:shadow-emerald-500/50 transition-all duration-300 hover:scale-105 overflow-hidden"
                            data-id="{{ $character['id'] }}"
                            data-name="{{ e($character['name']) }}"
                            data-image="{{ e($character['image']) }}"
                            aria-pressed="{{ $isFavorited ? 'true' : 'false' }}"
                        >
                            <span id="favoriteBtnText" class="relative z-10 flex items-center gap-2">
                                {{ $btnText }}
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </button>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-8 py-4 bg-slate-800/50 border border-slate-600 rounded-xl font-semibold text-slate-300 hover:text-emerald-400 transition-all duration-300 hover:scale-105">
                           Login to Save Favorite
                        </a>
                    @endauth
                </div>
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
.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('favoriteBtn');
    if (!btn) return;

    async function setButtonState(isFavorited) {
        const textEl = document.getElementById('favoriteBtnText');
        if (!textEl) return;

        if (isFavorited) {
            // Set to "remove" state
            btn.classList.remove('from-emerald-500', 'to-cyan-500');
            btn.classList.add('from-red-500', 'to-pink-500');
            textEl.innerHTML = '♥ Remove from Favorites';
            btn.setAttribute('aria-pressed', 'true');
        } else {
            // Set to "add" state
            btn.classList.remove('from-red-500', 'to-pink-500');
            btn.classList.add('from-emerald-500', 'to-cyan-500');
            textEl.innerHTML = '★ Add to Favorites';
            btn.setAttribute('aria-pressed', 'false');
        }
    }

    btn.addEventListener('click', async (e) => {
        e.preventDefault();
        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const image = btn.dataset.image;

        if (!id) return;

        // disable while processing
        btn.disabled = true;
        const prevText = document.getElementById('favoriteBtnText').innerHTML;

        try {
            const res = await fetch('{{ route('favorites.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    character_id: id,
                    character_name: name,
                    character_image: image
                })
            });

            const data = await res.json().catch(() => ({}));

            if (!res.ok) {
                throw new Error(data.message || 'Server error');
            }

            if (data.status === 'added') {
                await setButtonState(true);
            } else if (data.status === 'removed') {
                await setButtonState(false);
            }

            // update favorites count if server returned it
            if (typeof data.favorites_count !== 'undefined') {
                const countEl = document.getElementById('favorites-count');
                if (countEl) countEl.textContent = data.favorites_count;
            }
        } catch (err) {
            console.error('Failed toggling favorite:', err);
            // on error, don't change the button; optionally show a flash
            // quick feedback (subtle shake)
            btn.style.transform = 'translateY(-3px)';
            setTimeout(() => { btn.style.transform = ''; }, 180);
        } finally {
            btn.disabled = false;
        }
    });
});
</script>
@endsection
