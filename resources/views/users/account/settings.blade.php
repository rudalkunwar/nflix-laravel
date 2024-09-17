@extends('users.account.sidebar')

@section('main')
    <!-- Main Content -->
    <div class="w-full md:w-3/4 xl:w-3/4 p-4">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>

            <!-- Profile Edit Form -->
            <form action="{{ route('user.account.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Assuming you're using PUT method for updates -->

                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="font-semibold">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="font-semibold">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address Field -->
                <div class="mb-4">
                    <label for="address" class="font-semibold">Address:</label>
                    <input type="text" id="address" name="address"
                        value="{{ old('address', auth()->user()->userDetails->address ?? '') }}"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Number Field -->
                <div class="mb-4">
                    <label for="phone_number" class="font-semibold">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number"
                        value="{{ old('phone_number', auth()->user()->userDetails->phone_number ?? '') }}"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('phone_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Photo Upload Field -->
                <div class="mb-4">
                    <label for="photo" class="font-semibold">Profile Photo:</label>
                    <input type="file" id="photo" name="photo" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('photo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
