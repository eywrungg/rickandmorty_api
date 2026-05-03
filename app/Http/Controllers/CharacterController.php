<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Services\RickAndMortyApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function __construct(private RickAndMortyApiService $api)
    {
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'name' => ['nullable', 'string', 'max:80', 'regex:/^[\pL\pN\s.\'-]+$/u'],
        ]);

        $page = (int) ($validated['page'] ?? 1);
        $name = isset($validated['name']) ? trim(strip_tags($validated['name'])) : null;
        $data = $this->api->getCharacterPage($page, $name);

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

    public function show($id)
    {
        abort_unless(filter_var($id, FILTER_VALIDATE_INT) !== false && (int) $id > 0, 404);

        $character = $this->api->getCharacter((int) $id);

        abort_if(! $character, 404);

        $favorites = [];
        if (Auth::check()) {
            $favorites = Favorite::where('user_id', Auth::id())->pluck('character_id')->toArray();
        }

        return view('characters.show', [
            'character' => $character,
            'favorites' => $favorites,
        ]);
    }
}
