@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center justify-center space-x-2">
            <i class="ri-movie-2-line text-gray-600"></i>
            <span>Edit Movie</span>
        </h2>
        <a href="{{ route('admin.movies.index') }}"
            class="bg-green-600 px-4 py-2 rounded-md text-white font-semibold hover:bg-green-700 transition flex items-center space-x-2">
            <i class="ri-arrow-left-line"></i>
            <span>Back</span>
        </a>
    </div>
    <div class="bg-gray-100">
        <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Movie Details</h2>

                <!-- Title Field -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Title</label>
                    <input type="text" id="title" name="title"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ old('title', $movie->title) }}" required>
                    @error('title')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Overview Field -->
                <div class="mb-4">
                    <label for="overview" class="block text-gray-700 text-sm font-medium mb-2">Overview</label>
                    <textarea id="overview" name="overview" rows="4" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('overview', $movie->overview) }}</textarea>
                    @error('overview')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Language Field -->
                <div class="mb-4">
                    <label for="language" class="block text-gray-700 text-sm font-medium mb-2">Language</label>
                    <select id="language" name="language" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" disabled {{ $movie->language == '' ? 'selected' : '' }}>Select Language
                        </option>
                        <option value="english" {{ $movie->language == 'english' ? 'selected' : '' }}>English</option>
                        <option value="nepali" {{ $movie->language == 'nepali' ? 'selected' : '' }}>Nepali</option>
                        <option value="hindi" {{ $movie->language == 'hindi' ? 'selected' : '' }}>Hindi</option>
                        <option value="french" {{ $movie->language == 'french' ? 'selected' : '' }}>French</option>
                        <option value="japanese" {{ $movie->language == 'japanese' ? 'selected' : '' }}>Japanese</option>
                    </select>
                    @error('language')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Director Field -->
                <div class="mb-4">
                    <label for="director_id" class="block text-gray-700 text-sm font-medium mb-2">Director</label>
                    <select id="director_id" name="director_id" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" disabled>Select Director</option>
                        @foreach ($directors as $director)
                            <option value="{{ $director->id }}"
                                {{ old('director_id', $movie->director_id) == $director->id ? 'selected' : '' }}>
                                {{ $director->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('director_id')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Casts Field -->
                <div class="mb-6">
                    <label for="casts" class="block text-gray-700 text-sm font-medium mb-2">Casts</label>
                    <div class="flex flex-wrap bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
                        @if ($casts->isEmpty())
                            <div>No Casts to select</div>
                        @else
                            @foreach ($casts as $cast)
                                <div class="mr-4 mb-2 flex items-center">
                                    <input type="checkbox" id="cast-{{ $cast->id }}" name="casts[]"
                                        value="{{ $cast->id }}"
                                        {{ in_array($cast->id, old('casts', $movie->actors->pluck('id')->toArray())) ? 'checked' : '' }}
                                        class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out">
                                    <label for="cast-{{ $cast->id }}"
                                        class="ml-2 text-gray-700">{{ $cast->name }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @error('casts')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Field -->
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 text-sm font-medium mb-2">Category</label>
                    <select id="category_id" name="category_id" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" disabled>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $movie->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Genres Field -->
                <div class="mb-6">
                    <label for="genres" class="block text-gray-700 text-sm font-medium mb-2">Genres</label>
                    <div class="flex flex-wrap bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
                        @if ($genres->isEmpty())
                            <div>No Genres to select</div>
                        @else
                            @foreach ($genres as $genre)
                                <div class="mr-4 mb-2 flex items-center">
                                    <input type="checkbox" id="genre-{{ $genre->id }}" name="genres[]"
                                        value="{{ $genre->id }}"
                                        {{ in_array($genre->id, old('genres', $movie->genres->pluck('id')->toArray())) ? 'checked' : '' }}
                                        class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out">
                                    <label for="genre-{{ $genre->id }}"
                                        class="ml-2 text-gray-700">{{ $genre->name }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @error('genres')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Release Date Field -->
                <div class="mb-4">
                    <label for="release_date" class="block text-gray-700 text-sm font-medium mb-2">Release Date</label>
                    <input type="date" id="release_date" name="release_date" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ old('release_date', $movie->release_date->format('Y-m-d')) }}">
                    @error('release_date')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poster Image Field -->
                <div class="mb-4">
                    <label for="poster_image" class="block text-gray-700 text-sm font-medium mb-2">Poster Image</label>
                    <img class="w-24" src="{{ asset('storage/movies/' . $movie->poster_image) }}"
                        alt="{{ 'poster' . $movie->title }}">
                    <input type="file" id="poster_image" name="poster_image"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('poster_image')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Backdrop Image Field -->
                <div class="mb-4">
                    <label for="backdrop_image" class="block text-gray-700 text-sm font-medium mb-2">Backdrop
                        Image</label>
                    <img class="w-24" src="{{ asset('storage/movies/' . $movie->backdrop_image) }}"
                        alt="{{ 'bg' . $movie->title }}">
                    <input type="file" id="backdrop_image" name="backdrop_image"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('backdrop_image')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video Path Field -->
                <div class="mb-4">
                    <label for="video_path" class="block text-gray-700 text-sm font-medium mb-2">Video File</label>
                    <span class="text-red-500">You cannot change the already uploaded video .</span>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 px-6 py-2 w-full rounded-lg text-white shadow-lg hover:bg-green-700 transition-colors duration-300">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
