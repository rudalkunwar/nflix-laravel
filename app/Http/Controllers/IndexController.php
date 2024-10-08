<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\MergeSortAlgorithm;
use App\Services\RecommendationAlgorithm;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    protected $mergesort;
    protected $recommend;

    public function __construct(MergeSortAlgorithm $mergesort, RecommendationAlgorithm $recommend)
    {
        $this->mergesort = $mergesort;
        $this->recommend = $recommend;
    }

    public function home()
    {
        $movie = Movie::inRandomOrder()->first();
        return view('users.home', compact('movie'));
    }

    public function show($id)
    {
        $movie = Movie::with('genres', 'actors', 'ratings')->find($id);

        if (!$movie) {
            abort(404, 'Movie not found.');
        }

        // Calculate the average rating
        $movieRating = $movie->ratings()->avg('rating');
        $userRating = $movie->ratings()->where('user_id', auth()->id())->first();

        return view('users.movie', compact('movie', 'userRating', 'movieRating',));
    }

    public function movies(Request $request)
    {
        $genres = Genre::all();
        $movies = Movie::with('genres')->get(); // Load all movies with genres

        $selectedGenre = $request->input('genres');
        $sortBy = $request->input('sort_by');

        // Filter movies by genre
        if ($selectedGenre) {
            $movies = $this->mergesort->filterByGenre($movies, $selectedGenre);
        }

        // Sort movies
        if ($sortBy) {
            $movies = $this->mergesort->sortAscending($movies, $sortBy); // or sortDescending
        }

        return view('users.movies', compact('movies', 'genres'));
    }

    public function actor($id)
    {
        $actor = Actor::with('movies')->find($id);

        if (!$actor) {
            abort(404, 'Actor not found.');
        }

        return view('users.actor', compact('actor'));
    }

    public function director($id)
    {
        $director = Director::find($id);

        if (!$director) {
            abort(404, 'Director not found.');
        }

        return view('users.director', compact('director'));
    }

    public function genre($id)
    {
        $genre = Genre::with('movies')->find($id);

        if (!$genre) {
            abort(404, 'Genre not found.');
        }

        return view('users.genre', compact('genre'));
    }

    public function popularMovies(Request $request, $limit = 10)
    {
        // Step 1: Fetch movies with genres
        $movies = Movie::with('genres')->get();
        $genres = Genre::all();

        // Step 2: Filter by selected genre (if any)
        $selectedGenre = $request->input('genres');

        if ($selectedGenre) {
            $movies = $this->mergesort->filterByGenre($movies, $selectedGenre);
        }

        // Step 3: Sort movies by average rating
        $movies = $movies->sortByDesc(function ($movie) {
            return $this->calculateAverageRating($movie->id);
        });

        // Step 4: Limit the number of movies based on the limit parameter
        $movies = $movies->take($limit);

        // Return the view with the filtered and sorted movies
        return view('users.popular-movies', compact('movies', 'genres', 'selectedGenre'));
    }

    function calculateAverageRating($movieId)
    {
        $ratings = Rating::where('movie_id', $movieId)->get();

        if ($ratings->count() > 0) {
            // Calculate the average rating of the movie
            return $ratings->avg('rating');
        }

        return 0;  // If no ratings are available, return 0
    }
}
