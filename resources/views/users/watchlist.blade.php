@extends('users.layouts.app')
@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto py-4 flex items-center gap-3">
        <a href="{{ route('user.home') }}" class="text-blue-600 text-base">
            <i class="ri-home-line"></i>
        </a>
        <span>Watchlists</span>
        <span class="text-sm text-gray-400">
            <i class="ri-arrow-right-s-line"></i>
        </span>
    </div>
    <div class="p-6 w-full bg-gray-100 min-h-screen">
        <div class="bg-white shadow-lg rounded-lg p-6 md:p-8">
            <div class="flex justify-between items-center mb-6 border-b border-gray-300 pb-4">
                <h1 class="text-3xl font-extrabold text-gray-800">My Watchlist</h1>
            </div>

            @if ($watchlists->isEmpty())
                <div class="text-center text-gray-500 py-12">
                    <p class="text-2xl font-semibold">No movies in your Watchlist yet.</p>
                    <p class="text-lg mt-2">Start adding some of your favorite movies!</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8 py-4">
                    @foreach ($watchlists as $movie)
                        <div
                            class="relative group shadow-lg rounded-lg overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                            <img class="h-[220px] md:h-[350px] w-full object-cover object-top rounded-t-lg"
                                src="{{ asset('storage/movies/' . $movie->poster_image) }}" alt="{{ $movie->title }}" />
                            <div
                                class="absolute inset-0 flex justify-center items-center bg-black bg-opacity-70 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('user.movie.show', $movie->id) }}" class="text-white text-4xl mr-4">
                                    <i class="ri-play-circle-fill"></i>
                                </a>
                                <form action="{{ route('user.watchlists.delete', $movie->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white text-4xl hover:text-red-600">
                                        <i class="ri-delete-bin-6-fill"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-4">
                                <h2 class="text-white text-lg font-bold truncate">{{ $movie->title }}</h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
