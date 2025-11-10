<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Favorite;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch all favorites with image + name
        $favorites = Favorite::where('user_id', $user->id)
            ->select('character_id', 'name', 'image')
            ->get();

        return view('profile.index', compact('user', 'favorites'));
    }

    public function edit()
    {
        // Redirect to index instead of trying to load non-existent view
        return redirect()->route('profile.index');
    }

    /**
     * Update logged-in user's password (current password required)
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validate input
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Check current password
        if (! Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        // Update password
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Optionally: regenerate session to be safe
        $request->session()->regenerate();

        return back()->with('status', 'Password updated successfully.');
    }
}