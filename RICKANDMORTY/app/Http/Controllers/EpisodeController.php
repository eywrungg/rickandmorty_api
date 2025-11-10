<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    // Show paginated + filtered episodes
    public function index(Request $request)
    {
        $season = $request->query('season');
        $episodeNum = $request->query('episode_num');
        $name = $request->query('name');

        // Fetch all episodes across all pages
        $allEpisodes = [];
        $url = "https://rickandmortyapi.com/api/episode";

        do {
            $response = Http::get($url);
            if ($response->failed()) break;

            $data = $response->json();
            $allEpisodes = array_merge($allEpisodes, $data['results']);
            $url = $data['info']['next']; // Go to next page
        } while ($url);

        // Apply filters
        $episodes = collect($allEpisodes)
            ->when($season, fn($q) => $q->filter(fn($ep) => str_contains($ep['episode'], 'S' . $season)))
            ->when($episodeNum, fn($q) => $q->filter(fn($ep) => str_contains($ep['episode'], 'E' . str_pad($episodeNum, 2, '0', STR_PAD_LEFT))))
            ->when($name, fn($q) => $q->filter(fn($ep) => str_contains(strtolower($ep['name']), strtolower($name))))
            ->values();

        // Basic pagination (manual)
        $perPage = 20;
        $page = max(1, (int)$request->query('page', 1));
        $paged = $episodes->forPage($page, $perPage);

        $info = [
            'prev' => $page > 1 ? "?page=" . ($page - 1) : null,
            'next' => $episodes->count() > $page * $perPage ? "?page=" . ($page + 1) : null,
        ];

        return view('episodes.index', [
            'episodes' => $paged,
            'info' => $info,
            'season' => $season,
            'episode_num' => $episodeNum,
            'name' => $name,
        ]);
    }

    // Show single episode
  public function show($id)
{
    $response = Http::get("https://rickandmortyapi.com/api/episode/{$id}");

    if ($response->failed()) {
        abort(404, 'Episode not found.');
    }

    $episode = $response->json();

    // Fetch all character details (the API supports multiple IDs in one call)
    $characterUrls = $episode['characters'];
    $characterIds = collect($characterUrls)->map(function ($url) {
        return basename($url);
    })->implode(',');

    $characters = [];
    if ($characterIds) {
        $charResponse = Http::get("https://rickandmortyapi.com/api/character/{$characterIds}");
        if ($charResponse->successful()) {
            $data = $charResponse->json();
            $characters = isset($data[0]) ? $data : [$data]; // normalize single item
        }
    }

    return view('episodes.show', compact('episode', 'characters'));
}
}
