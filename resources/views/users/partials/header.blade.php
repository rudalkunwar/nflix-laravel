<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Import CSS for Video.js and its plugins -->
    <link rel="stylesheet" href="https://unpkg.com/video.js/dist/video-js.min.css">

    <!-- Import JS for Video.js and its plugins -->
    <script src="https://unpkg.com/video.js/dist/video.min.js"></script>
    <script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.min.js"></script>
    <script src="https://unpkg.com/videojs-hls-quality-selector/dist/videojs-hls-quality-selector.min.js"></script>
</head>

<body>
    <div class="bg-black sticky top-0 z-20 w-full">
        <nav class="mx-10 flex justify-between items-center py-6">
            <div class="flex items-center space-x-8">
                <a href="{{ route('user.home') }}">
                    <img width="100" src="{{ asset('nflogo.png') }}" alt="Nflix Logo">
                </a>
                <ul class="nav flex space-x-8 text-lg">
                    <li>
                        <a href="{{ route('user.home') }}" class="text-white hover:text-gray-400 font-semibold">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('user.movies.popular') }}"
                            class="text-white hover:text-gray-400 font-semibold cursor-pointer">Popular Movies</a>
                    </li>
                    <li>
                        <a href="{{ route('user.movies.all') }}"
                            class="text-white hover:text-gray-400 font-semibold cursor-pointer">Movies</a>
                    </li>
                    <li>
                        <a href="{{ route('user.watchlists') }}"
                            class="text-white hover:text-gray-400 font-semibold cursor-pointer">My List</a>
                    </li>
                    <li>
                        <a href="{{ route('user.premium') }}"
                            class="text-white hover:text-gray-400 font-semibold cursor-pointer">Premium</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('user.search') }}">
                    <svg stroke="currentColor" fill="white" stroke-width="0" viewBox="0 0 512 512" height="20px"
                        width="20px" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0034.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 00327.3 362.6l94.09 94.09a25 25 0 0035.3-35.3zM97.92 222.72a124.8 124.8 0 11124.8 124.8 124.95 124.95 0 01-124.8-124.8z">
                        </path>
                    </svg>
                </a>
                <a href="#">
                    <svg stroke="currentColor" fill="white" stroke-width="0" viewBox="0 0 512 512" height="20px"
                        width="20px" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M440.08 341.31c-1.66-2-3.29-4-4.89-5.93-22-26.61-35.31-42.67-35.31-118 0-39-9.33-71-27.72-95-13.56-17.73-31.89-31.18-56.05-41.12a3 3 0 01-.82-.67C306.6 51.49 282.82 32 256 32s-50.59 19.49-59.28 48.56a3.13 3.13 0 01-.81.65c-56.38 23.21-83.78 67.74-83.78 136.14 0 75.36-13.29 91.42-35.31 118-1.6 1.93-3.23 3.89-4.89 5.93a35.16 35.16 0 00-4.65 37.62c6.17 13 19.32 21.07 34.33 21.07H410.5c14.94 0 28-8.06 34.19-21a35.17 35.17 0 00-4.61-37.66zM256 480a80.06 80.06 0 0070.44-42.13 4 4 0 00-3.54-5.87H189.12a4 4 0 00-3.55 5.87A80.06 80.06 0 00256 480z">
                        </path>
                    </svg>
                </a>
                <a href="{{ route('user.account.profile') }}">
                    @if (auth()->user()->userDetails && auth()->user()->userDetails->photo)
                        <img src="{{ asset('storage/users/' . auth()->user()->userDetails->photo) }}"
                            alt="Profile Photo" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <img src="{{ asset('user-avatar.png') }}" alt="Default Profile" class="w-7 h-7 rounded-md">
                    @endif
                </a>
            </div>
        </nav>
    </div>
