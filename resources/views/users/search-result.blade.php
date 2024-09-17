@extends('users.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto py-4 flex items-center gap-3">
        <a href="{{ route('user.home') }}" class="text-blue-600 text-base">
            <i class="ri-home-line"></i>
        </a>
        <span>Search</span>
        <span class="text-sm text-gray-400">
            <i class="ri-arrow-right-s-line"></i>
        </span>
        <span>Results</span>
    </div>
    <div class="container mx-auto px-4 py-8">
        <div class="rounded-lg shadow-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-black mb-6">Search results for: {{ $query }}</h1>
            <!-- Search Results -->
            @if ($movies->count() > 0)
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
            @else
                <div class="text-center text-gray-500 py-8">No Movies found.</div>
            @endif
        </div>
    </div>
@endsection
