@extends('users.layouts.app')
@section('content')
    <div class="relative text-white">
        <!-- Background Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black opacity-70"></div>

        @if (!$movie)
            <div class="relative w-full h-[70vh] md:h-[90vh] flex justify-center items-center">
                <h2 class="text-white">
                    No movies aviliable right now.
                </h2>
            </div>
        @else
            <!-- Movie Background Image -->
            <img src="{{ asset('storage/movies/' . $movie->backdrop_image) }}"
                class="w-full h-[70vh] md:h-[90vh] object-cover object-top" alt="Movie Title" />

            <!-- Movie Details -->
            <div class="absolute w-full bottom-0 md:bottom-[8%] p-4 md:p-8">
                <h1 class="text-3xl md:text-6xl font-semibold">
                    <a href="path_to_movie">
                        {{ $movie->title }}
                    </a>
                </h1>

                <!-- Action Buttons -->
                <div class="mt-4 md:flex space-x-4">
                    <!-- Play Button -->
                    <a href="{{ route('user.movie.show', $movie->id) }}"
                        class="flex items-center px-5 py-2 bg-gray-300 text-black hover:bg-gray-700 hover:text-white transition duration-300 ease-in-out">
                        <i class="ri-play-fill text-2xl mr-2"></i>
                        <span class="text-base font-semibold">Play</span>
                    </a>

                    <!-- Watch Later Button -->
                    <a href="#"
                        class="flex items-center px-5 py-2 border-2 border-gray-300 hover:bg-gray-400 hover:text-black transition duration-300 ease-in-out">
                        <i class="ri-add-fill text-xl mr-2"></i>
                        <span class="text-base font-semibold">Watch Later</span>
                    </a>
                </div>


                <!-- Movie Additional Info -->
                <div class="hidden sm:block">
                    <p class="mt-4 text-sm text-gray-400">{{ $movie->release_date->format('F j, Y') }}</p>
                    <p class="mt-2 md:max-w-[70%] lg:max-w-[50%] xl:max-w[35%] text-gray-200">
                        {{ $movie->overview }}
                    </p>
                </div>
            </div>
        @endif
    </div>
@endsection
