<?php

namespace App\Http\Controllers;

use App\Services\RickAndMortyApiService;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function __construct(private RickAndMortyApiService $api)
    {
    }

    public function index(Request $request)
    {
        $season = $request->query('season');
        $episodeNum = $request->query('episode_num');
        $name = $request->query('name');

        $episodes = collect($this->api->getAllEpisodes())
            ->when($season, fn ($query) => $query->filter(fn ($episode) => str_contains($episode['episode'], 'S' . $season)))
            ->when($episodeNum, fn ($query) => $query->filter(fn ($episode) => str_contains($episode['episode'], 'E' . str_pad($episodeNum, 2, '0', STR_PAD_LEFT))))
            ->when($name, fn ($query) => $query->filter(fn ($episode) => str_contains(strtolower($episode['name']), strtolower($name))))
            ->values();

        $perPage = 20;
        $page = max(1, (int) $request->query('page', 1));
        $paged = $episodes->forPage($page, $perPage);

        $info = [
            'prev' => $page > 1 ? '?page=' . ($page - 1) : null,
            'next' => $episodes->count() > $page * $perPage ? '?page=' . ($page + 1) : null,
        ];

        return view('episodes.index', [
            'episodes' => $paged,
            'info' => $info,
            'season' => $season,
            'episode_num' => $episodeNum,
            'name' => $name,
            'total_results' => $episodes->count(),
        ]);
    }

    public function show($id)
    {
        $episode = $this->api->getEpisode((int) $id);

        if (! $episode) {
            abort(404, 'Episode not found.');
        }

        $characters = $this->api->getCharactersFromUrls($episode['characters'] ?? []);

        return view('episodes.show', compact('episode', 'characters'));
    }
}
