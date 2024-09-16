@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center justify-center space-x-2">
            <i class="ri-list-settings-line text-gray-600"></i>
            <span>Add Genre</span>
        </h2>
        <a href="{{ route('admin.genres.index') }}"
            class="bg-green-600 px-4 py-2 rounded-md text-white font-semibold hover:bg-green-700 transition flex items-center space-x-2">
            <i class="ri-arrow-left-line"></i>
            <span>Back</span>
        </a>
    </div>
    <div class="bg-white p-4 rounded-md shadow-md flex justify-center items-center">
        <div class="flex-1 max-w-3xl p-8 m-4 shadow-md bg-white rounded-lg">
            <h4 class="text-2xl font-semibold text-blue-gray-800 mb-4 text-center">Add New Genre</h4>
            <form action="{{ route('admin.genres.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" />
                </div>
                @error('name')
                    <h2 class="text-red-500">{{ $message }}</h2>
                @enderror
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <h2 class="text-red-500">{{ $message }}</h2>
                @enderror
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Add
                    Genre</button>
            </form>
        </div>
    </div>
@endsection
