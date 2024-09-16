@extends('users.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Movie Details -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row">
                <!-- Video Player -->
                <div class="w-full md:w-2/3">
                    <video id="video-player" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto"
                        width="950px" height="500px"> <!-- Adjusted height for better visibility -->
                        <source src="http://127.0.0.1:8000/movie/{{ $movie->id }}/stream/" type="application/x-mpegURL">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <!-- Movie Info -->
                <div class="md:w-1/3 p-4 mt-6 md:mt-0">
                    <h1 class="text-4xl font-extrabold text-white mb-4">{{ strtoupper($movie->title) }}</h1>
                    <div class="flex flex-col text-gray-400 mb-4">
                        <span>Released : {{ $movie->release_date->format('M d, Y') }}</span>
                        <span>Genres : {{ $movie->genres->pluck('name')->join(', ') }} </span>
                    </div>
                    <p class="text-gray-300 mb-4">{{ $movie->overview }}</p>

                    <!-- Director -->
                    @if ($movie->director)
                        <div class="mt-6 w-full">
                            <h4 class="text-white font-semibold text-lg mb-2">Director</h4>
                            <div class="text-center">
                                <a href="{{ route('user.director.show', $movie->director->id) }}">
                                    <img src="{{ Storage::url('directors/' . $movie->director->photo) }}"
                                        alt="{{ $movie->director->name }}"
                                        class="mb-2 hover:opacity-75 transition ease-in-out duration-150">
                                    <span class="text-lg text-gray-300 text-center">{{ $movie->director->name }}</span>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Cast and Crew -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-3xl font-bold text-white mb-4">Cast</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($movie->actors as $actor)
                    <div class="text-center">
                        <a href="{{ route('user.actor.show', $actor->id) }}">
                            <img src="{{ Storage::url('casts/' . $actor->photo) }}" alt="{{ $actor->name }}"
                                class="rounded-lg mb-2 hover:opacity-75 transition ease-in-out duration-150">
                            <span class="text-lg text-gray-300">{{ $actor->name }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

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
@endsection
