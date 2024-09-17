<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the user's watchlist.
     */
    public function index()
    {
        $watchlists = Watchlist::where('user_id', Auth::id())
            ->with('movie') // Load the related movie
            ->get()
            ->pluck('movie');

        $genres = Genre::all();

        return view('users.watchlist', compact('watchlists', 'genres'));
    }

    /**
     * Store a newly created watchlist item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
        ]);

        $exists = Watchlist::where('user_id', Auth::id())
            ->where('movie_id', $request->movie_id)
            ->exists(); // Check if the movie is already in the watchlist

        if ($exists) {
            return back()->with('error', 'Movie already in your watchlist!');
        }

        Watchlist::create([
            'user_id' => Auth::id(),
            'movie_id' => $request->movie_id,
        ]);

        return back()->with('success', 'Movie added to your watchlist!');
    }

    /**
     * Remove the specified movie from the watchlist.
     */
    public function destroy($movie_id)
    {
        $deleted = Watchlist::where('user_id', Auth::id())
            ->where('movie_id', $movie_id)
            ->delete(); // Delete the movie from the watchlist

        if ($deleted) {
            return back()->with('success', 'Movie removed from your watchlist.');
        }

        return back()->with('error', 'Movie not found in your watchlist.');
    }
}
