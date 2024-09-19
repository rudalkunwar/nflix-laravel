@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold flex items-center space-x-2">
            <i class="ri-user-line text-gray-600"></i>
            <span>Edit Profile</span>
        </h2>
    </div>

    <!-- Update Profile Info -->
    <div class="w-full md:w-3/4 xl:w-3/4 p-4 mx-auto">
        <div class="bg-white shadow-md rounded p-6">
            <h2 class="text-xl font-semibold mb-4">Update Profile Info</h2>
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="font-semibold">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="font-semibold">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address Field -->
                <div class="mb-4">
                    <label for="address" class="font-semibold">Address:</label>
                    <input type="text" id="address" name="address"
                        value="{{ old('address', $admin->userDetails->address ?? '') }}"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="mb-4">
                    <label for="phone" class="font-semibold">Phone:</label>
                    <input type="text" id="phone" name="phone"
                        value="{{ old('phone', $admin->userDetails->phone ?? '') }}"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 w-full">
                        Update Profile Info
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
