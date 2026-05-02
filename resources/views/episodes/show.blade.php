@extends('layouts.app')

@section('title', $episode['name'])

@section('content')
<section class="site-shell space-y-8">
    <a href="{{ route('episodes.index') }}" class="ghost-button w-fit">
        <x-ui.icon name="arrow-left" class="h-4 w-4" />
        Back to episodes
    </a>

    <div class="grid gap-8 lg:grid-cols-[0.9fr,1.1fr]">
        <div class="panel panel-pad">
            <span class="stack-label">Episode dossier</span>
            <h1 class="section-title mt-3">{{ $episode['name'] }}</h1>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <article class="stat-card">
                    <span class="stack-label">Code</span>
                    <strong>{{ $episode['episode'] }}</strong>
                    <p class="record-subtitle">Season and episode identifier.</p>
                </article>
                <article class="stat-card">
                    <span class="stack-label">Air date</span>
                    <strong class="text-3xl">{{ $episode['air_date'] }}</strong>
                    <p class="record-subtitle">Original broadcast metadata from the API.</p>
                </article>
            </div>
        </div>

        <div class="panel panel-pad">
            <span class="stack-label">Cast snapshot</span>
            <p class="lead-copy mt-3">
                Browse the full cast for this episode and jump straight into each connected character profile.
            </p>
        </div>
    </div>

    <div class="space-y-5">
        <div class="flex items-end justify-between gap-4">
            <div>
                <span class="stack-label">Characters</span>
                <h2 class="section-title mt-2">Episode cast</h2>
            </div>
            <span class="data-chip">{{ count($characters) }} resolved records</span>
        </div>

        @if(count($characters) > 0)
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-5">
                @foreach($characters as $character)
                    <article class="record-card">
                        <div class="record-media">
                            <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}">
                        </div>
                        <div class="record-body">
                            <h3 class="record-title">{{ $character['name'] }}</h3>
                            <p class="record-subtitle">{{ $character['species'] }}</p>
                            <a href="{{ route('characters.show', $character['id']) }}" class="ghost-button w-full justify-between">
                                Open dossier
                                <x-ui.icon name="arrow-right" class="h-4 w-4" />
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="panel panel-pad">
                <p class="record-subtitle">No character records were returned for this episode.</p>
            </div>
        @endif
    </div>
</section>
@endsection
