<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegexSearchAlgorithm;
use App\Models\Movie;

class SearchController extends Controller
{
    protected $searchAlgorithm;

    public function __construct(RegexSearchAlgorithm $searchAlgorithm)
    {
        $this->searchAlgorithm = $searchAlgorithm;
    }

    public function index()
    {
        return view('users.search');
    }

    /**
     * Search for movies based on a query.
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:3',
        ]);

        $query = $request->input('query');

        $fields = ['title'];

        $allMovies = Movie::all();

        $movies = $this->searchAlgorithm->search($allMovies, $query, $fields);

        return view('users.search-result', compact('movies', 'query'));
    }
}
