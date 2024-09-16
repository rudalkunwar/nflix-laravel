@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold flex items-center space-x-2">
            <i class="ri-movie-2-line text-gray-600"></i>
            <span>Movies</span>
        </h2>
        <a href="{{ route('admin.movies.create') }}"
            class="bg-green-600 px-4 py-2 rounded-md text-white hover:bg-green-700 transition flex items-center space-x-2">
            <i class="ri-add-line"></i>
            <span>Add Movie</span>
        </a>
    </div>

    <div class="bg-white p-4 rounded-md shadow-md">
        <table class="w-full border-collapse bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-3 px-4 text-left">Title</th>
                    <th class="py-3 px-4 text-left">Poster</th>
                    <th class="py-3 px-4 text-left">Release Date</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                    <th class="py-3 px-4 text-left">More</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movies as $movie)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-4">{{ $movie->title }}</td>
                        <td class="py-3 px-4">
                            <img src="{{ asset('storage/movies/' . $movie->poster_image) }}" alt="{{ $movie->title }}"
                                class="w-16 h-16 object-cover rounded-full border border-gray-200">
                        </td>
                        <td class="py-3 px-4">{{ $movie->release_date->format('F d, Y') }}</td>
                        <td class="py-3 px-4 ">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.movies.edit', $movie->id) }}"
                                    class="text-blue-500 hover:text-blue-700 flex items-center space-x-1">
                                    <i class="ri-edit-line"></i>
                                    <span>Edit</span>
                                </a>
                                <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure to delete this movie ? ')" type="submit"
                                        class="text-red-500 hover:text-red-700 flex items-center space-x-1">
                                        <i class="ri-delete-bin-line"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <a class="text-blue-600 hover:underline" href="{{ route('admin.movies.show', $movie->id) }}">more</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-3 px-4 text-center text-gray-500">No movies found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
