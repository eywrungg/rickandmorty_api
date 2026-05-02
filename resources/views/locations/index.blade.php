@extends('layouts.app')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold mb-6">Rick and Morty Locations</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($locations as $loc)
        <div class="bg-white shadow rounded-xl p-4">
            <h2 class="font-semibold text-lg">{{ $loc['name'] }}</h2>
            <p class="text-gray-600">Type: {{ $loc['type'] }}</p>
            <p class="text-gray-600">Dimension: {{ $loc['dimension'] }}</p>
            <a href="{{ route('locations.show', $loc['id']) }}" class="text-blue-500 mt-2 inline-block">View Details →</a>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center mt-8 space-x-4">
        @if($info['prev'])
            <a href="?page={{ request('page', 1) - 1 }}" class="px-4 py-2 bg-gray-800 text-white rounded-lg">Previous</a>
        @endif

        @if($info['next'])
            <a href="?page={{ request('page', 1) + 1 }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Next</a>
        @endif
    </div>
</div>
@endsection
