@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold flex items-center space-x-2">
            <i class="ri-user-line text-gray-600"></i>
            <span>Settings</span>
        </h2>
    </div>
    <!-- Main Content -->
    <div class="w-full md:w-3/4 xl:w-3/4 p-4 mx-auto">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-2xl font-bold mb-6">Change Password</h1>

            <!-- Change Password Form -->
            <form action="{{ route('admin.account.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Current Password Field -->
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-semibold mb-1">Current Password:</label>
                    <input type="password" id="current_password" name="current_password"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('current_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password Field -->
                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-semibold mb-1">New Password:</label>
                    <input type="password" id="new_password" name="new_password"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('new_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm New Password Field -->
                <div class="mb-4">
                    <label for="new_password_confirmation" class="block text-sm font-semibold mb-1">Confirm New
                        Password:</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('new_password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 w-full">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
