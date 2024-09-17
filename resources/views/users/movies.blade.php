@extends('users.layouts.app')
@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto py-4 flex items-center gap-3">
        <a href="{{ route('user.home') }}" class="text-blue-600 text-base">
            <i class="ri-home-line"></i>
        </a>
        <span>All Movies</span>
        <span class="text-sm text-gray-400">
            <i class="ri-arrow-right-s-line"></i>
        </span>
    </div>
    <div class="p-6 w-full bg-gray-100 min-h-screen">
        <div class="bg-white shadow-lg rounded-lg p-6 md:p-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h1 class="text-3xl font-extrabold text-gray-800 mb-4 md:mb-0">Movies</h1>
                <div class="flex items-center space-x-2">
                    <form method="GET" action="{{ route('user.movies.all') }}" class="flex items-center">
                        <div class="flex items-center space-x-2">
                            <label for="genres" class="text-gray-700 font-semibold">Filter By Genre:</label>
                            <select name="genres" id="genres"
                                class="border border-gray-300 rounded-md pl-4 pr-8 py-2 capitalize text-gray-700 hover:border-gray-400 focus:outline-none focus:ring focus:ring-indigo-500">
                                <option value="">All Genres</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->name }}"
                                        {{ request('genres') == $genre->name ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <label for="sort_by" class="text-gray-700 font-semibold">Sort By:</label>
                            <select name="sort_by" id="sort_by"
                                class="border border-gray-300 rounded-md pl-4 pr-8 py-2 capitalize text-gray-700 hover:border-gray-400 focus:outline-none focus:ring focus:ring-indigo-500">
                                <option value="">Select Sort Option</option>
                                <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title</option>
                                <option value="release_date" {{ request('sort_by') == 'release_date' ? 'selected' : '' }}>
                                    Release Date</option>
                                <!-- Add more sorting options as needed -->
                            </select>
                        </div>
                        <button type="submit"
                            class="ml-4 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Apply
                        </button>
                    </form>
                </div>
            </div>

            <hr class="my-4 border-gray-300" />
            @if (count($movies) === 0)
                <div class="text-center text-gray-500 py-12">
                    <p class="text-xl font-medium">No movies to display.</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach ($movies as $movie)
                        <div
                            class="relative group shadow-lg rounded-lg overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl text-center">
                            <img class="h-[180px] md:h-[350px] w-full object-cover object-top"
                                src="{{ asset('storage/movies/' . $movie->poster_image) }}" alt="{{ $movie->title }}" />

                            <div
                                class="absolute inset-0 flex justify-center items-center bg-black bg-opacity-60 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('user.movie.show', $movie->id) }}" class="text-white text-4xl mr-4">
                                    <i class="ri-play-circle-fill"></i>
                                </a>
                                <form action="{{ route('user.watchlists.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                    <button type="submit" class="text-white text-4xl">
                                        <i class="ri-add-circle-fill"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-3">
                                <span class="text-white text-lg font-semibold">{{ strtoupper($movie->title) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
