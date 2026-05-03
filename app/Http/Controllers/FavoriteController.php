<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Services\RickAndMortyApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct(private RickAndMortyApiService $api)
    {
    }

    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'character_id' => ['required', 'integer', 'min:1', 'max:10000'],
            'character_name' => ['nullable', 'string', 'max:255'],
            'character_image' => ['nullable', 'url', 'max:2048'],
        ]);

        $user = Auth::user();

        $existing = Favorite::where('user_id', $user->id)
            ->where('character_id', $validated['character_id'])
            ->first();

        if ($existing) {
            $existing->delete();

            return response()->json([
                'status' => 'removed',
                'favorites_count' => Favorite::where('user_id', $user->id)->count(),
            ]);
        }

        $character = $this->api->getCharacter((int) $validated['character_id']);

        if (! $character) {
            return response()->json([
                'message' => 'Unable to verify that character right now.',
            ], 422);
        }

        Favorite::create([
            'user_id' => $user->id,
            'character_id' => $validated['character_id'],
            'name' => $character['name'] ?? $validated['character_name'] ?? 'Unknown',
            'image' => $character['image'] ?? $validated['character_image'] ?? null,
        ]);

        return response()->json([
            'status' => 'added',
            'favorites_count' => Favorite::where('user_id', $user->id)->count(),
        ]);
    }

    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $detailsById = collect($this->api->getCharactersByIds($favorites->pluck('character_id')->all()))
            ->keyBy('id');

        $favoritesWithDetails = $favorites->map(function ($favorite) use ($detailsById) {
            $details = $detailsById->get($favorite->character_id, []);

            return [
                'id' => $favorite->character_id,
                'name' => $details['name'] ?? $favorite->name,
                'image' => $details['image'] ?? $favorite->image,
                'status' => $details['status'] ?? 'Unknown',
                'species' => $details['species'] ?? 'Unknown',
                'gender' => $details['gender'] ?? 'Unknown',
                'location' => data_get($details, 'location.name', 'Unknown'),
            ];
        });

        return view('favorites.index', ['favorites' => $favoritesWithDetails]);
    }
}
