@extends('layouts.app')

@section('title', 'Favorites')

@section('content')
<section class="site-shell space-y-8">
    <div class="grid gap-8 lg:grid-cols-[1.05fr,0.95fr] lg:items-end">
        <div class="space-y-5">
            <h1 class="page-display">
                Favorite
                <span class="signal-text">vault</span>
            </h1>
            <p class="lead-copy">
                Your saved characters live here so you can jump back into the ones you like most without searching again.
            </p>
        </div>
        <div class="panel panel-pad">
            <div class="grid gap-4 sm:grid-cols-2">
                <article class="stat-card">
                    <span class="stack-label">Saved records</span>
                    <strong data-favorites-count>{{ count($favorites) }}</strong>
                    <p class="record-subtitle">Characters stored against your account.</p>
                </article>
                <article class="stat-card">
                    <span class="stack-label">Quick access</span>
                    <strong class="text-3xl">Instant</strong>
                    <p class="record-subtitle">Open or remove saved characters directly from the grid.</p>
                </article>
            </div>
        </div>
    </div>

    @if($favorites->isEmpty())
        <div class="panel panel-pad" data-favorites-empty>
            <span class="stack-label">No saved entries</span>
            <h2 class="mt-3 text-3xl font-extrabold" style="font-family: var(--font-display);">Your vault is empty.</h2>
            <p class="mt-3 record-subtitle">Start in the character explorer and save a few profiles to build your collection.</p>
            <div class="mt-5">
                <a href="{{ route('characters.index') }}" class="accent-button">
                    <x-ui.icon name="dossier" class="h-4 w-4" />
                    Browse characters
                </a>
            </div>
        </div>
    @else
        <div class="hidden panel panel-pad" data-favorites-empty>
            <span class="stack-label">No saved entries</span>
            <h2 class="mt-3 text-3xl font-extrabold" style="font-family: var(--font-display);">Your vault is empty now.</h2>
            <p class="mt-3 record-subtitle">All saved favorites were removed from this session view.</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            @foreach($favorites as $favorite)
                @php
                    $statusClass = strtolower($favorite['status']) === 'alive' ? 'alive' : (strtolower($favorite['status']) === 'dead' ? 'dead' : 'unknown');
                @endphp
                <article class="record-card" data-favorite-card>
                    <div class="record-media">
                        <img src="{{ $favorite['image'] }}" alt="{{ $favorite['name'] }}">
                        <div class="absolute left-4 top-4 z-10">
                            <span class="status-pill {{ $statusClass }}">
                                <x-ui.icon :name="'status-'.$statusClass" class="h-4 w-4" />
                                {{ $favorite['status'] }}
                            </span>
                        </div>
                        <div class="absolute right-4 top-4 z-10">
                            <button
                                type="button"
                                class="favorite-toggle is-active"
                                data-favorite-toggle
                                data-favorite-url="{{ route('favorites.toggle') }}"
                                data-favorite-id="{{ $favorite['id'] }}"
                                data-favorite-name="{{ $favorite['name'] }}"
                                data-favorite-image="{{ $favorite['image'] }}"
                                data-remove-card-on-unfavorite="true"
                                aria-pressed="true"
                            >
                                <span data-favorite-icon>
                                    <x-ui.icon name="favorite" class="h-5 w-5" :filled="true" />
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="record-body">
                        <div>
                            <h2 class="record-title">{{ $favorite['name'] }}</h2>
                            <p class="record-subtitle mt-2">{{ $favorite['species'] }} · {{ $favorite['gender'] }}</p>
                        </div>
                        <div class="info-stack">
                            <div class="info-row">
                                <span class="info-label">Last known location</span>
                                <span class="info-value">{{ $favorite['location'] }}</span>
                            </div>
                        </div>
                        <a href="{{ route('characters.show', $favorite['id']) }}" class="ghost-button w-full justify-between">
                            Open dossier
                            <x-ui.icon name="arrow-right" class="h-4 w-4" />
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection
