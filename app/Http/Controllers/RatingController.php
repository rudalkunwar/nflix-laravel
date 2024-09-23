<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',

            'rating' => 'required|numeric|min:1|max:5',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'movie_id' => $request->movie_id,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return redirect()->back()->with('success', 'Movie Rated Successfully');
    }
}
