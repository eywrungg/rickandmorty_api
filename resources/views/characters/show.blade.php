@extends('layouts.app')

@section('title', $character['name'])

@section('content')
<section class="site-shell space-y-8">
    <a href="{{ route('characters.index') }}" class="ghost-button w-fit">
        <x-ui.icon name="arrow-left" class="h-4 w-4" />
        Back to characters
    </a>

    @php
        $isFavorite = in_array($character['id'], $favorites ?? [], true);
        $statusClass = strtolower($character['status']) === 'alive' ? 'alive' : (strtolower($character['status']) === 'dead' ? 'dead' : 'unknown');
    @endphp

    <div class="grid gap-8 lg:grid-cols-[0.92fr,1.08fr] lg:items-start">
        <div class="hero-visual min-h-[30rem]">
            <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}">
        </div>

        <div class="space-y-6">
            <div class="space-y-4">
                <span class="status-pill {{ $statusClass }}">
                    <x-ui.icon :name="'status-'.$statusClass" class="h-4 w-4" />
                    {{ $character['status'] }}
                </span>
                <h1 class="page-display">{{ $character['name'] }}</h1>
                <p class="lead-copy">{{ $character['species'] }} · {{ $character['gender'] }} · {{ data_get($character, 'origin.name', 'Unknown origin') }}</p>
            </div>

            <div class="detail-list md:grid md:grid-cols-2">
                <div>
                    <dt>Origin</dt>
                    <dd>{{ data_get($character, 'origin.name', 'Unknown') }}</dd>
                </div>
                <div>
                    <dt>Current location</dt>
                    <dd>{{ data_get($character, 'location.name', 'Unknown') }}</dd>
                </div>
                <div>
                    <dt>Species</dt>
                    <dd>{{ $character['species'] }}</dd>
                </div>
                <div>
                    <dt>Gender</dt>
                    <dd>{{ $character['gender'] }}</dd>
                </div>
            </div>

            @auth
                <div class="panel panel-pad flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="stack-label">Personal action</p>
                        <p class="record-subtitle mt-2">Save or remove this character from your favorites vault.</p>
                    </div>
                    <button
                        type="button"
                        class="accent-button {{ $isFavorite ? 'is-active' : '' }}"
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
                        <span data-favorite-label>{{ $isFavorite ? 'Saved' : 'Save' }}</span>
                    </button>
                </div>
            @else
                <a href="{{ route('login') }}" class="ghost-button w-fit">
                    <x-ui.icon name="profile" class="h-4 w-4" />
                    Login to save favorites
                </a>
            @endauth
        </div>
    </div>
</section>
@endsection
