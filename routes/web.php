<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page (Public)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Auth::routes(['verify' => false]); // Disable email verification routes since we use OTP

// OTP Route (must be accessible to guests for registration)
Route::post('/send-otp', [RegisterController::class, 'sendOtp'])
    ->middleware('throttle:3,3') // Max 3 requests per 3 minutes
    ->name('send.otp');

// Redirect /home to dashboard
Route::get('/home', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Require Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    // Characters
    Route::prefix('characters')->name('characters.')->group(function () {
        Route::get('/', [CharacterController::class, 'index'])->name('index');
        Route::get('/{id}', [CharacterController::class, 'show'])->name('show');
    });

    // Episodes
    Route::prefix('episodes')->name('episodes.')->group(function () {
        Route::get('/', [EpisodeController::class, 'index'])->name('index');
        Route::get('/{id}', [EpisodeController::class, 'show'])->name('show');
    });

    // Favorites
    Route::prefix('favorites')->name('favorites.')->group(function () {
        Route::get('/', [FavoriteController::class, 'index'])->name('index');
        Route::post('/toggle', [FavoriteController::class, 'toggle'])
            ->middleware('throttle:60,1') // Max 60 requests per minute
            ->name('toggle');
    });

    // Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/password', [ProfileController::class, 'updatePassword'])
            ->middleware('throttle:5,1') // Max 5 password changes per minute
            ->name('password.update');
    });
});

/*
|--------------------------------------------------------------------------
| API Routes (Optional - for AJAX requests)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('api')->name('api.')->group(function () {
    // Add any API endpoints here if needed
    // Example: Route::get('/user', function (Request $request) { return $request->user(); });
});

/*
|--------------------------------------------------------------------------
| Fallback Route (404 Handler)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    if (auth()->check()) {
        return redirect()->route('dashboard')->with('error', 'Page not found.');
    }
    return redirect()->route('home')->with('error', 'Page not found.');
});