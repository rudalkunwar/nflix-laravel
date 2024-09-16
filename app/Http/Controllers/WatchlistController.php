<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use App\Models\Movie;
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

        return view('users.watchlist', compact('watchlists'));
    }

    /**
     * Store a newly created watchlist item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
        ]);


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
        // Use composite key to find and delete the watchlist entry
        $watchlist = Watchlist::where('user_id', Auth::id())
            ->where('movie_id', $movie_id)
            ->firstOrFail();

        $watchlist->delete();

        return back()->with('success', 'Movie removed from your watchlist.');
    }
}
