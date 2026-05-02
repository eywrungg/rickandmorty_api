@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="site-shell space-y-8">
    <div class="grid gap-8 lg:grid-cols-[1.1fr,0.9fr] lg:items-end">
        <div class="space-y-5">
            <h1 class="page-display">
                Welcome back,
                <span class="signal-text">{{ Auth::user()->name }}</span>
            </h1>
            <p class="lead-copy">
                Check the latest universe totals, jump into characters or episodes, and save featured characters without leaving the dashboard.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('characters.index') }}" class="accent-button">
                    <x-ui.icon name="dossier" class="h-4 w-4" />
                    Browse Characters
                </a>
                <a href="{{ route('episodes.index') }}" class="ghost-button">
                    <x-ui.icon name="archive" class="h-4 w-4" />
                    Explore Episodes
                </a>
                <a href="{{ route('profile.index') }}" class="ghost-button">
                    <x-ui.icon name="profile" class="h-4 w-4" />
                    Profile
                </a>
            </div>
        </div>

        <div class="panel panel-pad">
            <div class="grid gap-4 sm:grid-cols-2">
                <article class="stat-card">
                    <span class="stack-label">Characters</span>
                    <strong>{{ $stats['characters'] }}</strong>
                    <p class="record-subtitle">Characters currently available across the Rick and Morty universe.</p>
                </article>
                <article class="stat-card">
                    <span class="stack-label">Locations</span>
                    <strong>{{ $stats['locations'] }}</strong>
                    <p class="record-subtitle">Known locations and dimensions pulled from the API dataset.</p>
                </article>
                <article class="stat-card">
                    <span class="stack-label">Episodes</span>
                    <strong>{{ $stats['episodes'] }}</strong>
                    <p class="record-subtitle">Browse the full episode archive and jump into cast details.</p>
                </article>
                <article class="stat-card">
                    <span class="stack-label">Favorites</span>
                    <strong data-favorites-count>{{ count($favorites) }}</strong>
                    <p class="record-subtitle">Your saved character list, tied directly to your account.</p>
                </article>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <a href="{{ route('characters.index') }}" class="panel panel-pad transition-transform hover:-translate-y-1">
            <span class="stack-label">Characters</span>
            <h2 class="mt-3 text-2xl font-extrabold" style="font-family: var(--font-display);">Character dossiers</h2>
            <p class="mt-3 record-subtitle">Search, paginate, inspect, and save any character profile from across the multiverse.</p>
        </a>
        <a href="{{ route('episodes.index') }}" class="panel panel-pad transition-transform hover:-translate-y-1">
            <span class="stack-label">Episodes</span>
            <h2 class="mt-3 text-2xl font-extrabold" style="font-family: var(--font-display);">Episodes</h2>
            <p class="mt-3 record-subtitle">Filter by season, number, or title, then jump into the cast list for each episode.</p>
        </a>
        <a href="{{ route('favorites.index') }}" class="panel panel-pad transition-transform hover:-translate-y-1">
            <span class="stack-label">Favorites</span>
            <h2 class="mt-3 text-2xl font-extrabold" style="font-family: var(--font-display);">Favorite vault</h2>
            <p class="mt-3 record-subtitle">Review your saved characters in one place and remove them whenever you want.</p>
        </a>
    </div>

    <div class="space-y-5">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="stack-label">Featured characters</span>
                <h2 class="section-title mt-2">Portal-side spotlight</h2>
            </div>
            <a href="{{ route('characters.index') }}" class="ghost-button">
                <x-ui.icon name="arrow-right" class="h-4 w-4" />
                View full catalog
            </a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($characters as $character)
                @php
                    $isFavorite = in_array($character['id'], $favorites, true);
                    $statusClass = strtolower($character['status']) === 'alive' ? 'alive' : (strtolower($character['status']) === 'dead' ? 'dead' : 'unknown');
                @endphp
                <article class="record-card">
                    <div class="record-media">
                        <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}">
                        <div class="absolute left-4 top-4 z-10">
                            <span class="status-pill {{ $statusClass }}">
                                <x-ui.icon :name="'status-'.$statusClass" class="h-4 w-4" />
                                {{ $character['status'] }}
                            </span>
                        </div>
                        <div class="absolute right-4 top-4 z-10">
                            <button
                                type="button"
                                class="favorite-toggle {{ $isFavorite ? 'is-active' : '' }}"
                                data-favorite-toggle
                                data-favorite-url="{{ route('favorites.toggle') }}"
                                data-favorite-id="{{ $character['id'] }}"
                                data-favorite-name="{{ $character['name'] }}"
                                data-favorite-image="{{ $character['image'] }}"
                                aria-pressed="{{ $isFavorite ? 'true' : 'false' }}"
                            >
                                <span data-favorite-icon>
                                    <x-ui.icon name="favorite" class="h-5 w-5" :filled="$isFavorite" />
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="record-body">
                        <div>
                            <h3 class="record-title">{{ $character['name'] }}</h3>
                            <p class="record-subtitle mt-2">{{ $character['species'] }} from {{ data_get($character, 'origin.name', 'Unknown origin') }}</p>
                        </div>
                        <div class="info-stack">
                            <div class="info-row">
                                <span class="info-label">Current location</span>
                                <span class="info-value">{{ data_get($character, 'location.name', 'Unknown') }}</span>
                            </div>
                        </div>
                        <a href="{{ route('characters.show', $character['id']) }}" class="ghost-button w-full justify-between">
                            Open dossier
                            <x-ui.icon name="arrow-right" class="h-4 w-4" />
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
