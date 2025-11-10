<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Favorite;

class CharacterController extends Controller
{
    protected $base = 'https://rickandmortyapi.com/api';

    /**
     * Show character list (with pagination, search, and favorite hearts)
     */
    public function index(Request $request)
    {
        $page = max(1, (int) $request->query('page', 1));
        $name = $request->query('name', null);
        $cacheKey = "chars_page_{$page}_name_" . md5($name ?? '');

        // Cache API response for 60 minutes
        $data = Cache::remember($cacheKey, 60, function () use ($page, $name) {
            $query = ['page' => $page];
            if ($name) $query['name'] = $name;
            $resp = Http::get($this->base . '/character', $query);
            return $resp->successful() ? $resp->json() : null;
        });

        // Load user's favorites (IDs only)
        $favorites = [];
        if (Auth::check()) {
            $favorites = Favorite::where('user_id', Auth::id())->pluck('character_id')->toArray();
        }

        return view('characters.index', [
            'data' => $data,
            'name' => $name,
            'page' => $page,
            'favorites' => $favorites,
        ]);
    }

    /**
     * Show single character details
     */
    public function show($id)
    {
        $cacheKey = "character_{$id}";
        $character = Cache::remember($cacheKey, 60 * 24, function () use ($id) {
            $resp = Http::get($this->base . "/character/{$id}");
            return $resp->successful() ? $resp->json() : null;
        });

        abort_if(!$character, 404);

        $favorites = [];
        if (Auth::check()) {
            $favorites = Favorite::where('user_id', Auth::id())->pluck('character_id')->toArray();
        }

        return view('characters.show', [
            'character' => $character,
            'favorites' => $favorites,
        ]);
    }

    /**
     * Toggle favorite (AJAX)
     */
    public function toggleFavorite(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $user = Auth::user();
        $charId = (int) $request->input('character_id');
        if (!$charId) {
            return response()->json(['status' => 'error', 'message' => 'No character id provided'], 400);
        }

        $existing = Favorite::where('user_id', $user->id)
            ->where('character_id', $charId)
            ->first();

        if ($existing) {
            // Remove from favorites
            $existing->delete();
            $favoritesCount = Favorite::where('user_id', $user->id)->count();

            return response()->json([
                'status' => 'removed',
                'favorites_count' => $favoritesCount,
            ]);
        } else {
            // Fetch character info from API (to save name + image)
            $resp = Http::get($this->base . "/character/{$charId}");
            if (!$resp->successful()) {
                return response()->json(['status' => 'error', 'message' => 'Character not found'], 404);
            }

            $payload = $resp->json();

            $fav = Favorite::create([
                'user_id' => $user->id,
                'character_id' => $charId,
                'name' => $payload['name'] ?? 'Unknown',
                'image' => $payload['image'] ?? '',
            ]);

            $favoritesCount = Favorite::where('user_id', $user->id)->count();

            return response()->json([
                'status' => 'added',
                'favorite' => $fav,
                'favorites_count' => $favoritesCount,
            ]);
        }
    }
}
