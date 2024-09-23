<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\BubbleSortAlgorithm;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    protected $bubbleSort;

    public function __construct(BubbleSortAlgorithm $bubbleSort)
    {
        $this->bubbleSort = $bubbleSort;
    }

    public function home()
    {
        $movie = Movie::inRandomOrder()->first();

        return view('users.home', compact('movie'));
    }

    public function show($id)
    {
        $movie = Movie::with('genres', 'actors', 'ratings')->find($id);

        // Calculate the average rating
        $movieRating = $movie->ratings()->avg('rating');

        $userRating = $movie->ratings()->where('user_id', auth()->id())->first();


        return view('users.movie', compact('movie', 'userRating', 'movieRating'));
    }

    public function movies(Request $request)
    {
        $movies = Movie::all();
        $genres = Genre::all();

        $selectedGenre = $request->input('genres');

        $sortBy = $request->input('sort_by');

        $movies = Movie::with('genres')->get(); // Load all movies with genres

        // Filter movies by genre
        if ($selectedGenre) {
            $movies = $this->bubbleSort->filterByGenre($movies, $selectedGenre);
        }

        // Sort movies
        if ($sortBy) {
            $movies = $this->bubbleSort->sortAscending($movies, $sortBy); // or sortDescending
        }

        return view('users.movies', compact('movies', 'genres'));
    }

    public function actor($id)
    {
        $actor = Actor::with('movies')->find($id);
        return view('users.actor', compact('actor'));
    }

    public function director($id)
    {
        $director = Director::find($id);
        return view('users.director', compact('director'));
    }

    public function genre($id)
    {
        $genre = Genre::with('movies')->find($id);
        return view('users.genre', compact('movies', 'genre'));
    }
}
