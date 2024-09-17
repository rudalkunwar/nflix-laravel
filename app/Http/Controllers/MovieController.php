<?php

namespace App\Http\Controllers;

use App\Jobs\VideoDecoder;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Name\FullyQualified;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $directors = Director::all();
        $casts = Actor::all();
        $genres = Genre::all();
        $categories = Category::all();
        return view('admin.movies.create', compact('directors', 'casts', 'genres', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|unique:movies',
            'overview' => 'required|string',
            'language' => 'required|string',
            'director_id' => 'nullable|exists:directors,id',
            'category_id' => 'nullable|exists:categories,id',
            'release_date' => 'required|date|before_or_equal:today',
            'poster_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'backdrop_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_path' => 'required|mimes:mp4,mov,ogg,qt|max:50000'
        ]);

        if ($request->hasFile('poster_image')) {
            $posterPath = $request->file('poster_image')->store('public/movies');
            $data['poster_image'] = basename($posterPath);
        }

        if ($request->hasFile('backdrop_image')) {
            $backdropPath = $request->file('backdrop_image')->store('public/movies');
            $data['backdrop_image'] = basename($backdropPath);
        }

        if ($request->hasFile('video_path')) {
            $videoPath = $request->file('video_path')->store('public/videos/movies');
            $data['video_path'] = basename($videoPath);
        }

        $movie = Movie::create($data);

        // Attach genres and casts if provided
        if ($request->has('casts')) {
            $movie->actors()->attach($request->input('casts'));
        }

        if ($request->has('genres')) {
            $movie->genres()->attach($request->input('genres'));
        }

        VideoDecoder::dispatch($data['video_path'], $data['title']);

        return view('admin.movies.movie-process', compact('movie'))->with('success', 'Movie Added and Started Processing');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::with('genres', 'actors')->find($id);
        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::with('genres', 'actors')->find($id);
        $directors = Director::all();
        $casts = Actor::all();
        $genres = Genre::all();
        $categories = Category::all();
        return view('admin.movies.edit', compact('movie', 'directors', 'casts', 'genres', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::find($id);
        $oldTitle = $movie->title;  // Capture the old title

        $data = $request->validate([
            'title' => 'required|string|max:255|unique:movies,title,' . $id,
            'overview' => 'required|string',
            'language' => 'required|string',
            'director_id' => 'nullable|exists:directors,id',
            'category_id' => 'nullable|exists:categories,id',
            'release_date' => 'required|date|before_or_equal:today',
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'backdrop_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle poster image replacement
        if ($request->hasFile('poster_image')) {
            Storage::delete('public/movies/' . $movie->poster_image);
            $posterPath = $request->file('poster_image')->store('public/movies');
            $data['poster_image'] = basename($posterPath);
        }

        // Handle backdrop image replacement
        if ($request->hasFile('backdrop_image')) {
            Storage::delete('public/movies/' . $movie->backdrop_image);
            $backdropPath = $request->file('backdrop_image')->store('public/movies');
            $data['backdrop_image'] = basename($backdropPath);
        }

        // Update movie record
        $movie->update($data);

        // Rename the HLS directory if the title has changed
        if ($oldTitle !== $data['title']) {
            $oldDir = public_path('movies/' . $oldTitle . '_hls');
            $newDir = public_path('movies/' . $data['title'] . '_hls');

            if (File::exists($oldDir)) {
                File::move($oldDir, $newDir);
            }
        }

        // Attach genres and casts if provided
        if ($request->has('casts')) {
            $movie->actors()->sync($request->input('casts'));
        }

        if ($request->has('genres')) {
            $movie->genres()->sync($request->input('genres'));
        }

        return redirect()->route('admin.movies.index')->with('success', 'Movie Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);

        if ($movie->poster_image) {
            Storage::delete('public/movies/' . $movie->poster_image);
        }
        if ($movie->backdrop_image) {
            Storage::delete('public/movies/' . $movie->backdrop_image);
        }
        if ($movie->video_path) {
            Storage::delete('public/videos/movies/' . $movie->video_path);
            $directory = public_path('movies/' . $movie->title . '_hls');
            if (File::exists($directory)) {
                // First, delete all files within the directory
                File::cleanDirectory($directory);
                rmdir($directory);
            }
        }

        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Movie Deleted');
    }

    public function getProgress($id)
    {
        $movie = Movie::find($id);
        return response()->json(['progress' => $movie->processing_progress]);
    }

    public function showMovieProgressPage($id)
    {
        $movie = Movie::find($id);
        return view('admin.movies.movie-process', compact('movie'))->with('success', 'Movie Added and Started Processing');
    }
}
