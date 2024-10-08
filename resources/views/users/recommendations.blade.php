@extends('users.layouts.app')
@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto pl-6 py-4 flex items-center gap-3">
        <a href="{{ route('user.home') }}" class="text-blue-600 text-base">
            <i class="ri-home-line"></i>
        </a>
        <span>Recommended</span>
        <span class="text-sm text-gray-400">
            <i class="ri-arrow-right-s-line"></i>
        </span>
    </div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Recommended for You</h2>
        @if ($recommendedMovies->isEmpty())
            <div class="h-screen text-center text-gray-500 py-12">
                <p class="text-xl font-medium">No recommendations available.</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($recommendedMovies as $movie)
                    <div class="relative group shadow-lg rounded-lg overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl text-center">
                        <img class="h-[180px] md:h-[350px] w-full object-cover object-top" src="{{ asset('storage/movies/' . $movie->poster_image) }}" alt="{{ $movie->title }}" />

                        <div class="absolute inset-0 flex justify-center items-center bg-black bg-opacity-60 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
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
@endsection
