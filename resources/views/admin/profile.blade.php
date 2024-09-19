@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold flex items-center space-x-2">
            <i class="ri-user-line text-gray-600"></i>
            <span>Admin Profile</span>
        </h2>
    </div>

    <div class="w-full md:w-3/4 xl:w-3/4 p-4 mx-auto">
        <div class="bg-white shadow-md rounded p-6">
            <!-- Profile Header -->
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-24 h-24 rounded-full bg-gray-200 overflow-hidden">
                    <img src="{{ $admin->userDetails?->photo ? Storage::url('public/users/' . $admin->userDetails->photo) : 'default-profile.jpg' }}"
                        alt="{{ $admin->name }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-2xl font-bold mb-2">{{ $admin->name }}</h1>
                    <p class="text-sm text-gray-600">{{ $admin->email }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ $admin->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div>
                <a href="{{ route('admin.profile.edit') }}" class="px-4 py-2 mb-2 rounded-md bg-green-500">Edit Profile</a>
            </div>

            <!-- Profile Details -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4 mt-2">Profile Details</h2>
                <p class="text-gray-700">Role: <span class="font-semibold">{{ $admin->role }}</span></p>
                <p class="text-gray-700">Joined on: <span
                        class="font-semibold">{{ $admin->created_at->format('F d, Y') }}</span></p>
                <p class="text-gray-700">Address: <span
                        class="font-semibold">{{ $admin->userDetails->address ?? 'Not set' }}</span></p>
                <p class="text-gray-700">Phone: <span
                        class="font-semibold">{{ $admin->userDetails->phone_number ?? 'Not set' }}</span></p>
            </div>

            <!-- Update Profile Picture -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Change Profile Picture</h2>
                <form action="{{ route('admin.profile.picture.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Profile Picture Upload Field -->
                    <div class="mb-4">
                        <input type="file" name="photo" accept="image/*"
                            class="form-input block w-full border-gray-300 rounded-md shadow-sm">
                        @error('photo')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 w-full">
                            Update Profile Picture
                        </button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
