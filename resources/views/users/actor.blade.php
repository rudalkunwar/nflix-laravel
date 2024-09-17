@extends('users.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto py-4 flex items-center gap-3">
        <a href="{{ route('user.home') }}" class="text-blue-600 text-base">
            <i class="ri-home-line"></i>
        </a>
        <span>Cast</span>
        <span class="text-sm text-gray-400">
            <i class="ri-arrow-right-s-line"></i>
        </span>
    </div>
    <div class="container mx-auto p-4 pt-6 md:p-6 lg:p-12">
        <div class="flex justify-center">
            <div class="w-full md:w-2/3 lg:w-1/2 xl:w-1/3">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="flex justify-center mb-4">
                        <h1 class="text-3xl font-bold">{{ $actor->name }}</h1>
                    </div>
                    <div class="flex justify-center mb-4">
                        @if ($actor->photo)
                            <img src="{{ Storage::url('casts/' . $actor->photo) }}" alt="{{ $actor->name }}"
                                class="w-48 h-48 rounded-full object-cover object-top">
                        @else
                            <img src="https://via.placeholder.com/200x200" alt="Actor Photo"
                                class="w-48 h-48 rounded-full object-cover">
                        @endif
                    </div>
                    <div class="mb-4 text-center">
                        <p class="text-gray-600">Birth Date:
                            {{ $actor->birth_date ? $actor->birth_date->format('M d, Y') : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h1 class="font-bold text-3xl"> Featured Movies</h1>
        </div>
        <hr class="my-4 border-gray-300" />
        @if (count($actor->movies) === 0)
            <div class="text-center text-gray-500 py-12">
                <p class="text-xl font-medium">No movies to display.</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($actor->movies as $movie)
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
                            <span class="text-white text-sm font-medium">{{ $movie->release_year }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
