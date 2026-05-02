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
        $request->validate([
            'character_id' => 'required|integer',
            'character_name' => 'nullable|string',
            'character_image' => 'nullable|string',
        ]);

        $user = Auth::user();

        $existing = Favorite::where('user_id', $user->id)
            ->where('character_id', $request->character_id)
            ->first();

        if ($existing) {
            $existing->delete();

            return response()->json([
                'status' => 'removed',
                'favorites_count' => Favorite::where('user_id', $user->id)->count(),
            ]);
        }

        $character = $this->api->getCharacter((int) $request->character_id);

        Favorite::create([
            'user_id' => $user->id,
            'character_id' => $request->character_id,
            'name' => $character['name'] ?? $request->character_name ?? 'Unknown',
            'image' => $character['image'] ?? $request->character_image,
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
