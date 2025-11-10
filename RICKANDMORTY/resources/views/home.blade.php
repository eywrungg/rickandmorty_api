@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-12">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-5xl font-orbitron font-black portal-text mb-2">
                    Welcome Back, {{ Auth::user()->name }}!
                </h1>
                <p class="text-gray-400 text-lg">Ready to explore the multiverse?</p>
            </div>
            <a href="{{ route('profile.index') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.26 2.632 1.732-.381.715-.145 1.582.433 2.11.578.528 1.393.545 2.11.433 1.472-.678 2.672 1.089 1.732 2.632-.27.44-.043 1.052.433 1.573.476.521.933.556 1.732.433 1.54-.383 2.672 1.088 1.632 2.73-.567.9-.44 1.772.433 2.11.878.34 1.434.901 1.732 1.732.298.83-.26 3.31-1.066 2.573-.715-.381-1.582-.145-2.11.433-.528.578-.545 1.393-.433 2.11.678 1.472-1.089 2.672-2.632 1.732-.44-.27-1.052-.043-1.573-.433-.521-.476-.556-.933-1.573-1.732-1.088-.878-1.772-.44-2.73-.433-.9.567-1.772.44-2.11-.433-.34-.878-.901-1.434-1.732-1.732-.83-.298-3.31.26-2.573-1.066.381-.715.145-1.582-.433-2.11-.578-.528-1.393-.545-2.11-.433-1.472.678-2.672-1.089-1.732-2.632.27-.44.043-1.052-.433-1.573-.476-.521-.933-.556-1.732-.433-1.54.383-2.672-1.088-1.632-2.73.567-.9.44-1.772-.433-2.11-.878-.34-1.434-.901-1.732-1.732-.298-.83.26-3.31 1.066-2.573.715.381 1.582.145 2.11-.433.528-.578.545-1.393.433-2.11-.678-1.472 1.089-2.672 2.632-1.732.44.27 1.052.043 1.573.433.521.476.556.933 1.573 1.732.878 1.088.44 1.772.433 2.73-.567.9-.44 1.772.433 2.11z"></path>
                </svg>
                Settings
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        @if(isset($stats['characters']))
        <div class="glass-effect rounded-xl p-6 portal-border hover:portal-glow transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Characters</p>
                    <p class="text-4xl font-bold text-portal-green">{{ $stats['characters'] ?? 0 }}</p>
                </div>
                <div class="text-5xl">👽</div>
            </div>
        </div>
        @endif

        @if(isset($stats['locations']))
        <div class="glass-effect rounded-xl p-6 portal-border hover:portal-glow transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Locations</p>
                    <p class="text-4xl font-bold text-portal-blue">{{ $stats['locations'] ?? 0 }}</p>
                </div>
                <div class="text-5xl">🌍</div>
            </div>
        </div>
        @endif

        @if(isset($stats['episodes']))
        <div class="glass-effect rounded-xl p-6 portal-border hover:portal-glow transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Episodes</p>
                    <p class="text-4xl font-bold text-portal-yellow">{{ $stats['episodes'] ?? 0 }}</p>
                </div>
                <div class="text-5xl">📺</div>
            </div>
        </div>
        @endif
    </div>

    <!-- Featured Characters -->
    @if(!empty($characters))
    <div class="mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-orbitron font-bold portal-text">Featured Characters</h2>
            <a href="{{ route('characters.index') }}" class="px-6 py-2 bg-portal-green/20 border border-portal-green/50 rounded-lg hover:bg-portal-green/30 transition text-portal-green">
                View All →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($characters as $character)
            <div class="glass-effect rounded-xl overflow-hidden hover:portal-glow transition transform hover:scale-105">
                @if(isset($character['image']) && $character['image'])
                    <img src="{{ $character['image'] }}" alt="{{ $character['name'] ?? 'Character' }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-700 flex items-center justify-center text-4xl">👽</div>
                @endif
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2">{{ $character['name'] ?? 'Unknown' }}</h3>
                    <p class="text-gray-400 text-sm">{{ $character['species'] ?? 'Unknown Species' }}</p>
                    @if(isset($character['location']['name']))
                        <p class="text-gray-500 text-xs">{{ $character['location']['name'] }}</p>
                    @endif
                    @if(isset($character['id']))
                        <a href="{{ route('characters.show', $character['id']) }}" class="mt-3 inline-block text-portal-green hover:text-portal-blue transition font-medium">
                            View Details →
                        </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-400 text-lg">No characters available yet.</p>
            </div>
            @endforelse
        </div>
    </div>
    @endif

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('characters.create') }}" class="glass-effect rounded-xl p-6 portal-border hover:portal-glow transition block">
            <div class="flex items-center gap-4">
                <div class="text-4xl">➕</div>
                <div>
                    <h3 class="text-xl font-bold mb-1">Create Character</h3>
                    <p class="text-gray-400 text-sm">Add a new character to your collection</p>
                </div>
            </div>
        </a>

        <a href="{{ route('locations.index') }}" class="glass-effect rounded-xl p-6 portal-border hover:portal-glow transition block">
            <div class="flex items-center gap-4">
                <div class="text-4xl">📍</div>
                <div>
                    <h3 class="text-xl font-bold mb-1">Explore Locations</h3>
                    <p class="text-gray-400 text-sm">Discover all locations across the multiverse</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection