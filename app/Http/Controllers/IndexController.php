<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use PhpParser\Node\Expr\FuncCall;

class IndexController extends Controller
{
    public function home()
    {
        $movie = Movie::inRandomOrder()->first();

        return view('users.home', compact('movie'));
    }
    public function show($id)
    {
        $movie = Movie::with('genres', 'actors')->find($id);

        return view('users.movie', compact('movie'));
    }
    public function movies()
    {
        $movies = Movie::all();
        $genres = Genre::all();

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
