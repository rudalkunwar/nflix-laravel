@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center space-x-2">
            <i class="ri-user-voice-line text-gray-600"></i>
            <span>Directors</span>
        </h2>
        <a href="{{ route('admin.directors.create') }}"
            class="bg-green-600 px-4 py-2 rounded-md text-white font-semibold hover:bg-green-700 transition flex items-center space-x-2">
            <i class="ri-add-line"></i>
            <span>Add Director</span>
        </a>
    </div>

    <div class="bg-white p-6 rounded-md shadow-md">
        <table class="w-full border-collapse bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Profile Picture</th>
                    <th class="py-3 px-4 text-left">Birth Date</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($directors as $director)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-4">{{ $director->name }}</td>
                        <td class="py-3 px-4">
                            <img src="{{ Storage::url('directors/' . $director->photo) }}" alt="{{ $director->name }}"
                                class="w-16 h-16 object-cover rounded-full border border-gray-200">

                        </td>
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($director->birth_date)->format('Y-m-d') }}</td>
                        <td class="py-3 px-4 flex items-center space-x-2">
                            <a href="{{ route('admin.directors.edit', $director->id) }}"
                                class="text-white hover:bg-blue-400 flex items-center space-x-1 bg-blue-500 rounded-md px-4 py-2">
                                <i class="ri-edit-line"></i>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.directors.destroy', $director->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-500 hover:bg-red-700 flex items-center space-x-1 rounded-md px-4 py-2"
                                    onclick="return confirm('Are you sure to delete?')">
                                    <i class="ri-delete-bin-line"></i>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-3 px-4 text-center text-gray-500">No directors found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
