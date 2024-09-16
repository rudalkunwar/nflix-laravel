@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center space-x-2">
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
        <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-lg mb-6 flex flex-col md:flex-row items-center">
            <img src="{{ asset('storage/movies/' . $movie->backdrop_image) }}" alt="{{ $movie->title }}"
                class="w-full md:w-48 h-auto rounded-lg shadow-lg mb-4 md:mb-0 md:mr-6">
            <div class="flex-1">
                <h3 class="text-2xl font-semibold text-gray-700 mb-2">{{ $movie->title }}</h3>
                <p class="text-gray-800 mb-4">{{ $movie->overview }}</p>
                <!-- Add more movie details as needed -->
            </div>
        </div>

        <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Processing Movie</h3>
            <div class="relative">
                <div class="w-full bg-gray-200 rounded-full">
                    <div id="progress-bar"
                        class="bg-blue-600 text-xs font-medium text-blue-100 text-center py-1 p-0.5 leading-none rounded-full"
                        style="width: 0%;">0%</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var progressBar = document.getElementById('progress-bar');

        function updateProgress() {
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.movies.progress', $movie->id) }}', // Use route hadmin.elper to generate URL
                success: function(data) {
                    var progress = data.progress;
                    progressBar.style.width = progress + '%';
                    progressBar.innerHTML = progress + '%';

                    // If progress is 100%, show "completed" and redirect after a delay
                    if (progress == 100) {
                        progressBar.innerHTML = '100% completed';
                        setTimeout(function() {
                            window.location.href ='{{ route('admin.movies.index') }}'; // Redirect to movies.index route
                      }, 2000); // Delay before redirecting to allow users to see the completed status
                    }
                }
            });
        }

        // Update the progress bar every 5 seconds
        setInterval(updateProgress, 5000);
    </script>

    <style>
        /* Add smooth transition to the progress bar */
        #progress-bar {
            transition: width 0.5s ease-in-out;
        }
    </style>
@endsection
