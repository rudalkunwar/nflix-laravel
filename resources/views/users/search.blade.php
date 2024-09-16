@extends('users.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Search Container -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-white mb-6">Search Movies</h1>
            
            <!-- Search Form -->
            <form method="GET" action="{{ route('user.movies.search') }}" class="flex items-center space-x-4">
                <input 
                    type="text" 
                    name="query" 
                    placeholder="Search for movies..." 
                    class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                />
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                    <i class="ri-search-line text-lg"></i>
                </button>
            </form>
        </div>

        <!-- Search Results -->
        @if(isset($movies) && count($movies) > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($movies as $movie)
                    <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <a href="{{ route('movie.show', $movie->id) }}">
                            <img 
                                src="{{ asset('storage/movies/' . $movie->poster_image) }}" 
                                alt="{{ $movie->title }}" 
                                class="w-full h-64 object-cover"
                            />
                            <div class="p-4">
                                <h2 class="text-xl font-semibold text-white truncate">{{ $movie->title }}</h2>
                                <p class="text-gray-400 mt-1">{{ $movie->release_date->format('M d, Y') }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 py-8">No results found.</div>
        @endif
    </div>
@endsection
