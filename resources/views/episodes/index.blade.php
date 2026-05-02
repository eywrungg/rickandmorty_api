@extends('layouts.app')

@section('title', 'Episodes')

@section('content')
<section class="site-shell space-y-8">
    <div class="space-y-5">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <h1 class="page-display">
                    Episode
                    <span class="signal-text">archive</span>
                </h1>
                <p class="lead-copy">
                    Search by name, season, or episode number and jump straight into the cast list for any episode.
                </p>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('episodes.index') }}" class="panel panel-pad">
        <div class="grid gap-3 lg:grid-cols-[1.6fr,0.8fr,0.7fr,auto,auto]">
            <label class="field-wrap">
                <span class="field-icon">
                    <x-ui.icon name="search" class="h-4 w-4" />
                </span>
                <input class="custom-field" type="text" name="name" value="{{ $name }}" placeholder="Search episode title">
            </label>
            <select class="custom-select" name="season">
                <option value="">All seasons</option>
                @for($i = 1; $i <= 7; $i++)
                    @php $seasonValue = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                    <option value="{{ $seasonValue }}" {{ $season === $seasonValue ? 'selected' : '' }}>Season {{ $i }}</option>
                @endfor
            </select>
            <input class="custom-field" type="text" name="episode_num" value="{{ $episode_num }}" maxlength="2" placeholder="Episode #">
            <button type="submit" class="accent-button">Filter</button>
            <a href="{{ route('episodes.index') }}" class="ghost-button justify-center">Reset</a>
        </div>
    </form>

    <div class="flex flex-wrap gap-3">
        <span class="data-chip">Page {{ request('page', 1) }}</span>
        <span class="data-chip">{{ $total_results }} matched episodes</span>
        @if($season)
            <span class="data-chip">Season {{ ltrim($season, '0') }}</span>
        @endif
        @if($episode_num)
            <span class="data-chip">Episode {{ $episode_num }}</span>
        @endif
    </div>

    @if(count($episodes) === 0)
        <div class="panel panel-pad">
            <span class="stack-label">Result</span>
            <h2 class="mt-3 text-3xl font-extrabold" style="font-family: var(--font-display);">No episodes matched the current filters.</h2>
            <p class="mt-3 record-subtitle">Try a broader title search or remove the season and episode constraints.</p>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($episodes as $episode)
                <article class="record-card">
                    <div class="record-body">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <span class="data-chip">{{ $episode['episode'] }}</span>
                            <span class="stack-label">{{ $episode['air_date'] }}</span>
                        </div>
                        <div>
                            <h2 class="record-title">{{ $episode['name'] }}</h2>
                            <p class="record-subtitle mt-3">Open the episode dossier to inspect its full cast and air-date details.</p>
                        </div>
                        <a href="{{ route('episodes.show', $episode['id']) }}" class="ghost-button w-full justify-between">
                            View episode
                            <x-ui.icon name="arrow-right" class="h-4 w-4" />
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="panel panel-pad">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="record-subtitle">Move through the filtered episode archive page by page.</p>
                <div class="flex flex-wrap gap-2">
                    @if($info['prev'])
                        <a href="?page={{ request('page', 1) - 1 }}{{ $name ? '&name='.$name : '' }}{{ $season ? '&season='.$season : '' }}{{ $episode_num ? '&episode_num='.$episode_num : '' }}" class="ghost-button">
                            <x-ui.icon name="arrow-left" class="h-4 w-4" />
                            Previous
                        </a>
                    @endif
                    <span class="data-chip">Current page {{ request('page', 1) }}</span>
                    @if($info['next'])
                        <a href="?page={{ request('page', 1) + 1 }}{{ $name ? '&name='.$name : '' }}{{ $season ? '&season='.$season : '' }}{{ $episode_num ? '&episode_num='.$episode_num : '' }}" class="ghost-button">
                            Next
                            <x-ui.icon name="arrow-right" class="h-4 w-4" />
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif
</section>
@endsection
