@extends('layouts.app')

@section('title', $episode['name'] . ' — Episode Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-900 text-white py-16 px-6">
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- Episode Header --}}
        <div class="text-center">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400 mb-4">
                {{ $episode['name'] }}
            </h1>
            <p class="text-slate-300 text-lg">{{ $episode['episode'] }} • Aired on {{ $episode['air_date'] }}</p>
        </div>

        {{-- Characters Section --}}
        <div class="bg-slate-900/40 border border-slate-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl">
            <h2 class="text-2xl font-bold mb-6 text-emerald-400">
                Characters in this Episode
            </h2>

            @if(count($characters) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($characters as $char)
                        <a href="{{ route('characters.show', $char['id']) }}"
                           class="group relative rounded-2xl overflow-hidden bg-slate-800/40 border border-slate-700/50 hover:scale-105 transition-transform duration-300 shadow-lg">
                            <img src="{{ $char['image'] }}" alt="{{ $char['name'] }}"
                                 class="w-full h-48 object-cover group-hover:opacity-90">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-80"></div>
                            <div class="absolute bottom-3 left-3 right-3 text-center">
                                <p class="font-semibold text-white truncate">{{ $char['name'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-slate-400">No characters found in this episode.</p>
            @endif
        </div>

        <div class="text-center">
            <a href="{{ route('episodes.index') }}"
               class="inline-block mt-6 px-6 py-3 bg-slate-800/50 border border-slate-600 rounded-xl font-semibold text-slate-300 hover:text-emerald-400 hover:scale-105 transition-all duration-300">
               ← Back to Episodes
            </a>
        </div>
    </div>
</div>
@endsection
