@extends('layouts.app')

@section('title', 'Characters')

@section('content')
<section class="site-shell space-y-8">
    <div class="space-y-5">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <h1 class="page-display">
                    Character
                    <span class="signal-text">dossiers</span>
                </h1>
                <p class="lead-copy">
                    Search by name, page through the live API results, and save profiles directly into your favorites vault.
                </p>
            </div>

            <form action="{{ route('characters.index') }}" method="GET" class="panel panel-pad w-full max-w-xl">
                <div class="grid gap-3 sm:grid-cols-[1fr,auto,auto]">
                    <label class="field-wrap">
                        <span class="field-icon">
                            <x-ui.icon name="search" class="h-4 w-4" />
                        </span>
                        <input class="custom-field" type="text" name="name" value="{{ $name ?? '' }}" placeholder="Search by character name">
                    </label>
                    <button type="submit" class="accent-button">Search</button>
                    <a href="{{ route('characters.index') }}" class="ghost-button justify-center">Reset</a>
                </div>
            </form>
        </div>

        @if($data)
            <div class="flex flex-wrap gap-3">
                <span class="data-chip">Page {{ $page }} / {{ $data['info']['pages'] }}</span>
                <span class="data-chip">{{ $data['info']['count'] }} total records</span>
                @if($name)
                    <span class="data-chip">Filtered by "{{ $name }}"</span>
                @endif
            </div>
        @endif
    </div>

    @if(!$data)
        <div class="panel panel-pad">
            <span class="stack-label">Result</span>
            <h2 class="mt-3 text-3xl font-extrabold" style="font-family: var(--font-display);">No character data returned.</h2>
            <p class="mt-3 record-subtitle">This usually means the name filter returned no matches or the API was temporarily unavailable.</p>
            <div class="mt-5">
                <a href="{{ route('characters.index') }}" class="accent-button">Clear search</a>
            </div>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            @foreach($data['results'] as $character)
                @php
                    $isFavorite = in_array($character['id'], $favorites ?? [], true);
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
                        @auth
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
                        @endauth
                    </div>
                    <div class="record-body">
                        <div>
                            <h2 class="record-title">{{ $character['name'] }}</h2>
                            <p class="record-subtitle mt-2">{{ $character['species'] }} · {{ $character['gender'] }}</p>
                        </div>
                        <div class="info-stack">
                            <div class="info-row">
                                <span class="info-label">Location</span>
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

        @php
            $current = (int) ($page ?? 1);
            $totalPages = $data['info']['pages'];
        @endphp

        <div class="panel panel-pad">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <p class="record-subtitle">Showing page {{ $current }} of {{ $totalPages }}.</p>
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('characters.index', ['page' => max(1, $current - 1), 'name' => $name]) }}" class="ghost-button {{ $current <= 1 ? 'pointer-events-none opacity-50' : '' }}">
                        <x-ui.icon name="arrow-left" class="h-4 w-4" />
                        Previous
                    </a>
                    @for($i = max(1, $current - 2); $i <= min($totalPages, $current + 2); $i++)
                        <a href="{{ route('characters.index', ['page' => $i, 'name' => $name]) }}" class="{{ $i === $current ? 'accent-button' : 'ghost-button' }}">
                            {{ $i }}
                        </a>
                    @endfor
                    <a href="{{ route('characters.index', ['page' => min($totalPages, $current + 1), 'name' => $name]) }}" class="ghost-button {{ $current >= $totalPages ? 'pointer-events-none opacity-50' : '' }}">
                        Next
                        <x-ui.icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>
            </div>
        </div>
    @endif
</section>
@endsection
