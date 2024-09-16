@extends('layouts.app')


@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center justify-center space-x-2">
            <i class="ri-movie-2-line text-gray-600"></i>
            <span>Movie Details</span>
        </h2>
        <a href="{{ route('admin.movies.index') }}"
            class="bg-green-600 px-4 py-2 rounded-md text-white font-semibold hover:bg-green-700 transition flex items-center space-x-2">
            <i class="ri-arrow-left-line"></i>
            <span>Back</span>
        </a>
    </div>
    <div class="min-h-screen bg-gray-100 flex flex-col items-center p-6 font-sans">
        <div class="max-w-screen-lg w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Movie Header -->
            <div class="relative">
                <img src="{{ asset('storage/movies/' . $movie->backdrop_image) }}" alt="Backdrop for {{ $movie->title }}"
                    class="w-full h-[400px] object-cover">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <video id="my-video" class="video-js" controls preload="auto" width="640" height="264"
                        poster="{{ asset('storage/movies/' . $movie->backdrop_image) }}" data-setup="{}">
                        <source src="{{ asset('storage/videos/movies/' . $movie->video_path) }}" type="video/mp4">
                    </video>
                </div>
            </div>

            <div class="p-6">
                <div class="flex flex-col md:flex-row items-center md:items-start">
                    <!-- Movie Poster -->
                    <div class="w-full md:w-1/3 flex justify-center">
                        <img src="{{ asset('storage/movies/' . $movie->poster_image) }}" alt="{{ $movie->title }}"
                            class="w-48 h-auto rounded-lg shadow-lg">
                    </div>

                    <!-- Movie Details -->
                    <div class="md:ml-6 md:w-2/3 mt-6 md:mt-0">
                        <h1 class="text-4xl font-bold text-gray-900">{{ $movie->title }}</h1>
                        <p class="text-gray-600 text-lg mt-2">{{ $movie->release_date->format('F d, Y') }}</p>
                        <p class="text-gray-800 text-lg mt-4">{{ $movie->overview }}</p>

                        <div class="mt-6">
                            <h2 class="text-xl font-semibold text-gray-800">Details</h2>
                            <ul class="list-disc pl-5 mt-2 text-gray-700">
                                <li>
                                    <strong>Director:</strong>
                                    <img src="{{ Storage::url('directors/' . $movie->director->photo) }}"
                                        alt="{{ $movie->director->name }}"
                                        class="w-12 h-12 rounded-full object-cover mr-2">
                                    <span> {{ $movie->director->name ?? 'N/A' }}</span>
                                </li>
                                <li><strong>Genres:</strong>
                                    @foreach ($movie->genres as $genre)
                                        {{ $genre->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </li>
                                <li><strong>Popularity:</strong> {{ $movie->popularity }}</li>
                            </ul>
                        </div>

                        <div class="mt-6">
                            <h2 class="text-xl font-semibold text-gray-800">Stars</h2>
                            <div class="flex flex-wrap mt-2">
                                @foreach ($movie->actors as $actor)
                                    <div class="flex items-center mr-4 mb-2">
                                        <img src="{{ Storage::url('casts/' . $actor->photo) }}" alt="{{ $actor->name }}"
                                            class="w-12 h-12 rounded-full object-cover mr-2">
                                        <span class="text-gray-800">{{ $actor->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
@endsection
