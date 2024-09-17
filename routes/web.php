<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\CategroyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieStreamController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('index');

// Authentication Routes
Route::get('register', [AuthController::class, 'registerPage'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'loginPage'])->name('login');
Route::post('login', [AuthController::class, 'login']);


// User Group Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    Route::get('/home', [IndexController::class, 'home'])->name('home');
    Route::get('/movie/{id}', [IndexController::class, 'show'])->name('movie.show');
    Route::get('/movies', [IndexController::class, 'movies'])->name('movies.all');
    Route::get('/actor/{id}/show', [IndexController::class, 'actor'])->name('actor.show');
    Route::get('/director/{id}/show', [IndexController::class, 'director'])->name('director.show');
    Route::get('/genre/{id}/show', [IndexController::class, 'genre'])->name('genre.show');



    // Account Routes
    Route::get('/account/profile', [UserAccountController::class, 'profile'])->name('account.profile');
    Route::put('/account/profile/update', [UserAccountController::class, 'updateProfile'])->name('account.update');
    Route::get('/account/settings', [UserAccountController::class, 'settings'])->name('account.settings');
    Route::get('/account/change-password', [UserAccountController::class, 'changePassword'])->name('account.change-password');
    Route::put('/account/password/update', [UserAccountController::class, 'updatePassword'])->name('account.password.update');
    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

    //search
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/search/movie', [SearchController::class, 'search'])->name('movies.search');

    //watchlist
    Route::get('/watchlists', [WatchlistController::class, 'index'])->name('watchlists');
    Route::post('/watchlists/add', [WatchlistController::class, 'store'])->name('watchlists.add');
    Route::delete('/watchlists/{movieId}/delete', [WatchlistController::class, 'destroy'])->name('watchlists.delete');
});

// Admin Group Routes
Route::middleware(['admin', 'auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Categories management
    Route::get('/categories', [CategroyController::class, 'index'])->name('categories.index');
    Route::get('/categories/add', [CategroyController::class, 'create'])->name('categories.create');
    Route::post('/categories/add', [CategroyController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategroyController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}/update', [CategroyController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}/delete', [CategroyController::class, 'destroy'])->name('categories.destroy');

    // Genres management
    Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
    Route::get('/genres/add', [GenreController::class, 'create'])->name('genres.create');
    Route::post('/genres/add', [GenreController::class, 'store'])->name('genres.store');
    Route::get('/genres/{id}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::put('/genres/{id}/update', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/genres/{id}/delete', [GenreController::class, 'destroy'])->name('genres.destroy');

    // Directors management
    Route::get('/directors', [DirectorController::class, 'index'])->name('directors.index');
    Route::get('/directors/add', [DirectorController::class, 'create'])->name('directors.create');
    Route::post('/directors/add', [DirectorController::class, 'store'])->name('directors.store');
    Route::get('/directors/{id}/edit', [DirectorController::class, 'edit'])->name('directors.edit');
    Route::put('/directors/{id}/update', [DirectorController::class, 'update'])->name('directors.update');
    Route::delete('/directors/{id}/delete', [DirectorController::class, 'destroy'])->name('directors.destroy');

    // Casts management
    Route::get('/casts', [CastController::class, 'index'])->name('casts.index');
    Route::get('/casts/add', [CastController::class, 'create'])->name('casts.create');
    Route::post('/casts/add', [CastController::class, 'store'])->name('casts.store');
    Route::get('/casts/{id}/edit', [CastController::class, 'edit'])->name('casts.edit');
    Route::put('/casts/{id}/update', [CastController::class, 'update'])->name('casts.update');
    Route::delete('/casts/{id}/delete', [CastController::class, 'destroy'])->name('casts.destroy');

    // Movies management
    Route::get('/movies/all', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/add', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies/add', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::get('/movies/{id}/show', [MovieController::class, 'show'])->name('movies.show');
    Route::put('/movies/{id}/update', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{id}/delete', [MovieController::class, 'destroy'])->name('movies.destroy');
    Route::get('/movies/{id}/progress', [MovieController::class, 'getProgress'])->name('movies.progress');
    Route::get('/movies/{id}/progress/show', [MovieController::class, 'showMovieProgressPage'])->name('movies.progress.show');
});

// Movie Streaming
Route::get('movie/{id}/stream/', [MovieStreamController::class, 'streamVideo'])->name('streamVideo');
Route::get('movie/{id}/stream/{quality}', [MovieStreamController::class, 'stream'])->name('stream');
