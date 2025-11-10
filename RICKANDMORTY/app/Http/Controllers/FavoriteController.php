<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Toggle (add or remove) a favorite character for the logged-in user.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'character_id' => 'required|integer',
            'character_name' => 'required|string',
            'character_image' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Check if favorite already exists
        $existing = Favorite::where('user_id', $user->id)
            ->where('character_id', $request->character_id)
            ->first();

        if ($existing) {
            // Remove from favorites
            $existing->delete();
            return response()->json(['status' => 'removed']);
        }

        // Add to favorites
        Favorite::create([
            'user_id' => $user->id,
            'character_id' => $request->character_id,
            'name' => $request->character_name,
            'image' => $request->character_image,
        ]);

        return response()->json(['status' => 'added']);
    }

    /**
     * Show the user's favorite characters with details from Rick and Morty API.
     */
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();

        // Fetch live character details from Rick and Morty API
        $favoritesWithDetails = $favorites->map(function ($fav) {
            $apiUrl = "https://rickandmortyapi.com/api/character/{$fav->character_id}";
            $response = @file_get_contents($apiUrl);

            if ($response) {
                $details = json_decode($response, true);
                return [
                    'id' => $fav->character_id,
                    'name' => $details['name'] ?? $fav->name,
                    'image' => $details['image'] ?? $fav->image,
                    'status' => $details['status'] ?? 'Unknown',
                    'species' => $details['species'] ?? 'Unknown',
                    'gender' => $details['gender'] ?? 'Unknown',
                    'location' => $details['location']['name'] ?? 'Unknown',
                ];
            }

            // fallback if API call fails
            return [
                'id' => $fav->character_id,
                'name' => $fav->name,
                'image' => $fav->image,
                'status' => 'Unknown',
                'species' => 'Unknown',
                'gender' => 'Unknown',
                'location' => 'Unknown',
            ];
        });

        return view('favorites.index', ['favorites' => $favoritesWithDetails]);
    }
}
