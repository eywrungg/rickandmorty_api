<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Services\RickAndMortyApiService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(private RickAndMortyApiService $api)
    {
    }

    public function index()
    {
        $stats = $this->api->getStats();
        $poolSize = max(6, min((int) ($stats['characters'] ?? 826), 826));
        $randomIds = collect(range(1, $poolSize))->random(min(6, $poolSize))->all();
        $characters = $this->api->getCharactersByIds($randomIds);

        $favorites = [];
        if (Auth::check()) {
            $favorites = Favorite::where('user_id', Auth::id())->pluck('character_id')->toArray();
        }

        return view('dashboard', compact('stats', 'characters', 'favorites'));
    }
}
