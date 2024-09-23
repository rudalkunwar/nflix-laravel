@extends('users.layouts.app')
@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto py-4 flex items-center gap-3">
        <a href="{{ route('user.home') }}" class="text-blue-600 text-base">
            <i class="ri-home-line"></i>
        </a>
        <span>Movie</span>
        <span class="text-sm text-gray-400">
            <i class="ri-arrow-right-s-line"></i>
        </span>
        <span>{{ strtoupper($movie?->title) }}</span>
    </div>
    @if (!$movie)
        <div>
            <h2>No movie to play</h2>
        </div>
    @else
        <div class="container mx-auto px-4 py-4">
            <!-- Movie Details -->
            <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row">
                    <!-- Video Player -->
                    <div class="w-full md:w-2/3">
                        <video id="video-player" class="video-js vjs-default-skin vjs-big-play-centered" controls
                            preload="auto" width="950px" height="500px"> <!-- Adjusted height for better visibility -->
                            <source src="http://127.0.0.1:8000/movie/{{ $movie->id }}/stream/"
                                type="application/x-mpegURL">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <!-- Movie Info -->
                    <div class="md:w-1/3 p-4 mt-6 md:mt-0">
                        <h1 class="text-4xl font-extrabold text-white mb-4">{{ strtoupper($movie->title) }}</h1>
                        <div class="flex flex-col text-gray-400 mb-4">
                            <span>Released : {{ $movie->release_date->format('M d, Y') }}</span>
                            <span>Genres : {{ $movie->genres->pluck('name')->join(', ') }} </span>
                            <span>Language : {{ $movie->language }} </span>
                            @if (isset($movieRating))
                                Movie Rating : <span class="text-yellow-400 font-bold">
                                    @for ($i = $movieRating; $i >= 1; $i--)
                                        <label for="hs-ratings-readonly-{{ $i }}"
                                            class="text-yellow-400 text-gray-300 pointer-events-none">
                                            <i class="ri-star-fill text-yellow-400 text-2xl"></i>
                                        </label>
                                    @endfor
                                </span>
                            @else
                                <label for="hs-ratings-readonly-1"
                                    class="text-yellow-400 text-gray-300 pointer-events-none">
                                    <i class="ri-star-fill text-yellow-400 text-2xl"></i>
                                </label>
                            @endif
                        </div>
                        <h4 class="text-white">Overview</h4>
                        <p class="text-gray-300 mb-4">{{ $movie->overview }}</p>
                        <!-- Director -->
                        @if ($movie->director)
                            <div class="mt-6 w-full">
                                <h4 class="text-white font-semibold text-lg mb-2">Director</h4>
                                <div class="w-[150px]">
                                    <a href="{{ route('user.director.show', $movie->director->id) }}">
                                        <img src="{{ Storage::url('directors/' . $movie->director->photo) }}"
                                            alt="{{ $movie->director->name }}"
                                            class="hover:opacity-75 transition ease-in-out duration-150">
                                    </a>
                                    <span
                                        class="text-lg text-gray-300 text-center w-full">{{ $movie->director->name }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cast and Crew -->
            <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                <h2 class="text-3xl font-bold text-white mb-4">Cast</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                    @foreach ($movie->actors as $actor)
                        <div class="w-[150px] text-center">
                            <a href="{{ route('user.actor.show', $actor->id) }}">
                                <img src="{{ Storage::url('casts/' . $actor->photo) }}" alt="{{ $actor->name }}"
                                    class="rounded-lg mb-2 hover:opacity-75 transition ease-in-out duration-150">
                                <span class="text-lg text-gray-300">{{ $actor->name }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Rating -->
            <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                <h2 class="text-3xl font-bold text-white mb-4">Download Movie</h2>
                <a href="{{ route('user.movie.download', $movie->id) }}"
                    class="bg-green-500 text-white px-6 py-3 rounded-full w-full flex items-center justify-center hover:bg-green-600 transition">
                    <i class="ri-download-2-line mr-2"></i> Download Movie
                </a>
            </div>
            <!-- Rating -->
            <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                <h2 class="text-3xl font-bold text-white mb-4">Rate Movie</h2>
                <div class="text-gray-300 mb-4">
                    @if (isset($userRating))
                        Your current rating: <span class="text-yellow-400 font-bold">
                            @for ($i = $userRating->rating; $i >= 1; $i--)
                                <label for="hs-ratings-readonly-{{ $i }}"
                                    class="text-yellow-400 text-gray-300 pointer-events-none">
                                    <i class="ri-star-fill text-yellow-400 text-2xl"></i>
                                </label>
                            @endfor
                        </span>
                    @else
                        You have not rated this movie yet.
                    @endif
                </div>
                <form action="{{ route('user.ratings') }}" method="post">
                    @csrf
                    <!-- Rating -->
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                    <div class="flex flex-row-reverse justify-end items-center">
                        @for ($i = 5; $i >= 1; $i--)
                            <input id="hs-ratings-readonly-{{ $i }}" type="radio"
                                class="peer -ms-5 size-8 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                name="rating" value="{{ $i }}">
                            <label for="hs-ratings-readonly-{{ $i }}"
                                class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                                <i class="ri-star-fill peer-checked:text-yellow-400 text-2xl"></i>
                            </label>
                        @endfor
                    </div>
                    <!-- End Rating -->
                    <button type="submit"
                        class="mt-4 bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                        Submit Rating
                    </button>
                </form>
            </div>
            <script>
                // Initialize Video.js player with HLS support and quality selector
                document.addEventListener('DOMContentLoaded', () => {
                    const videoElement = document.getElementById('video-player');

                    if (videoElement) {
                        const player = videojs(videoElement, {
                            techOrder: ['html5'],
                            sources: [{
                                src: `http://127.0.0.1:8000/movie/{{ $movie->id }}/stream/`,
                                type: 'application/x-mpegURL'
                            }]
                        });

                        player.hlsQualitySelector({
                            displayCurrentQuality: true
                        });

                        // player.play();
                    }
                });
            </script>
    @endif

@endsection
