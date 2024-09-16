@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold flex items-center space-x-2">
            <i class="ri-list-settings-line text-gray-600"></i>
            <span>Categories</span>
        </h2>
        <a href="{{ route('admin.categories.create') }}"
            class="bg-green-600 px-4 py-2 rounded-md text-white hover:bg-green-700 transition flex items-center space-x-2">
            <i class="ri-add-line"></i>
            <span>Add Category</span>
        </a>
    </div>

    <div class="bg-white p-4 rounded-md shadow-md">
        <table class="w-full border-collapse bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Priority</th>
                    <th class="py-3 px-4 text-left">Description</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-4">{{ $category->name }}</td>
                        <td class="py-3 px-4">{{ $category->priority }}</td>
                        <td class="py-3 px-4">{{ $category->description }}</td>
                        <td class="py-3 px-4 flex items-center space-x-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="text-blue-500 hover:text-blue-700 flex items-center space-x-1">
                                <i class="ri-edit-line"></i>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 flex items-center space-x-1"
                                    onclick="return confirm('Are you sure to delete?')">
                                    <i class="ri-delete-bin-line"></i>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-3 px-4 text-center">No categories found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
