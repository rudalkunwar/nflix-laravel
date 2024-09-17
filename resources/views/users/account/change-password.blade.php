@extends('users.account.sidebar')

@section('main')
    <!-- Main Content -->
    <div class="w-full md:w-3/4 xl:w-3/4 p-4">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-2xl font-bold mb-6">Change Password</h1>

            <!-- Change Password Form -->
            <form action="{{ route('user.account.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Current Password Field -->
                <div class="mb-4">
                    <label for="current_password" class="font-semibold">Current Password:</label>
                    <input type="password" id="current_password" name="current_password"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('current_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password Field -->
                <div class="mb-4">
                    <label for="new_password" class="font-semibold">New Password:</label>
                    <input type="password" id="new_password" name="new_password"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('new_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm New Password Field -->
                <div class="mb-4">
                    <label for="new_password_confirmation" class="font-semibold">Confirm New Password:</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('new_password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
