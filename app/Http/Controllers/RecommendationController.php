<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\RecommendationAlgorithm;

class RecommendationController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationAlgorithm $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id; // Assuming the user is authenticated

        // Get recommendations
        $movies = $this->recommendationService->recommendMovies($userId);

        // Fetch the recommended movie details if needed
        $recommendedMovies = Movie::find($movies); // Adjust to retrieve movie details

        return view('users.recommendations', compact('recommendedMovies'));
    }
}
