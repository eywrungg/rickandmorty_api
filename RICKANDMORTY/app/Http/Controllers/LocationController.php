<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // List all locations
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $response = Http::get("https://rickandmortyapi.com/api/location?page={$page}");

        if ($response->failed()) {
            abort(500, 'Failed to fetch locations from Rick and Morty API.');
        }

        $data = $response->json();
        $locations = $data['results'];
        $info = $data['info'];

        return view('locations.index', compact('locations', 'info'));
    }

    
    public function show($id)
    {
        $response = Http::get("https://rickandmortyapi.com/api/location/{$id}");

        if ($response->failed()) {
            abort(404, 'Location not found.');
        }

        $location = $response->json();

        return view('locations.show', compact('location'));
    }
}
