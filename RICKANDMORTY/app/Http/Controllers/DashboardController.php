<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Favorite;

class DashboardController extends Controller
{
    private $baseUrl = 'https://rickandmortyapi.com/api';

    // Dashboard view
    public function index()
    {
        // 1️⃣ Fetch stats (total characters, locations, episodes)
        $stats = Cache::remember('rm_stats', 3600, function () {
            $characters = Http::get($this->baseUrl . '/character')->json();
            $locations = Http::get($this->baseUrl . '/location')->json();
            $episodes = Http::get($this->baseUrl . '/episode')->json();

            return [
                'characters' => $characters['info']['count'] ?? 0,
                'locations' => $locations['info']['count'] ?? 0,
                'episodes' => $episodes['info']['count'] ?? 0,
            ];
        });

        // 2️⃣ Fetch 6 random characters for "Featured Characters"
        $characters = Cache::remember('rm_featured_chars', 3600, function () {
            $total = 826; // keep in sync with API size or use $stats['characters']
            $randomIds = collect(range(1, $total))->random(6)->toArray();

            $chars = Http::get($this->baseUrl . '/character/' . implode(',', $randomIds))->json();

            // When the API returns a single object for one id, convert to array
            if ($this->isAssoc($chars)) {
                return [$chars];
            }

            return $chars;
        });

        // 3️⃣ Fetch user favorites from DB as an array of character IDs (so in_array works in blade)
        $favorites = [];
        if (Auth::check()) {
            $favorites = Favorite::where('user_id', Auth::id())->pluck('character_id')->toArray();
        }

        return view('dashboard', compact('stats', 'characters', 'favorites'));
    }

    /**
     * Helper: check if array is associative
     */
    private function isAssoc(array $arr)
    {
        if ([] === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
