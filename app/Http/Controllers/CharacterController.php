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
        $page = max(1, (int) $request->query('page', 1));
        $name = $request->query('name');
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
