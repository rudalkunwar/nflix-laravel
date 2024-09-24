@extends('users.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto pl-6 py-4 flex items-center gap-3">
        <a href="{{ route('user.home') }}" class="text-blue-600 text-base">
            <i class="ri-home-line"></i>
        </a>
        <span>Serach</span>
        <span class="text-sm text-gray-400">
            <i class="ri-arrow-right-s-line"></i>
        </span>
    </div>
    <div class="container mx-auto px-4 py-8">
        <!-- Search Container -->
        <div class="rounded-lg shadow-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-black mb-6">Search Movies</h1>

            <!-- Search Form -->
            <form method="GET" action="{{ route('user.movies.search') }}" class="flex items-center space-x-4">
                <input type="text" name="query" placeholder="Search for movies..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-600 text-black focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                    value="{{ $query ?? '' }}" />
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i class="ri-search-line text-lg"></i>
                </button>
            </form>
        </div>

        <!-- Search Results -->
        @if (isset($query) && $query !== '' && isset($movies) && $movies->count() > 0)
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
        @elseif (isset($query) && $query !== '')
            <div class="text-center text-gray-500 py-8">No results found.</div>
        @endif
    </div>
@endsection
