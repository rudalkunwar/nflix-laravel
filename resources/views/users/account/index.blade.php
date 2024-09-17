@extends('users.account.sidebar')

@section('main')
    <!-- Main Content -->
    <div class="w-full md:w-3/4 xl:w-3/4 p-4">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-2xl font-bold mb-6">Profile Information</h1>

            <!-- Display user basic info -->
            <div class="mb-4">
                <label class="font-semibold">Name:</label>
                <p class="text-gray-700">{{ auth()->user()->name }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Email:</label>
                <p class="text-gray-700">{{ auth()->user()->email }}</p>
            </div>

            <!-- Check if userDetails exists before accessing properties -->
            @if (auth()->user()->userDetails)
                <div class="mb-4">
                    <label class="font-semibold">Address:</label>
                    <p class="text-gray-700">{{ auth()->user()->userDetails->address ?? 'N/A' }}</p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Phone Number:</label>
                    <p class="text-gray-700">{{ auth()->user()->userDetails->phone_number ?? 'N/A' }}</p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Account Status:</label>
                    <p class="text-gray-700">
                        {{ auth()->user()->userDetails->is_premium ? 'Premium' : 'Regular' }}
                    </p>
                </div>
            @else
                <div class="mb-4">
                    <p class="text-gray-700">User details not available.Complete your the profile in Settings</p>
                </div>
            @endif

            <!-- Edit Profile Link -->
            <a href="{{ route('user.account.settings') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
                Edit Profile
            </a>
        </div>
    </div>
@endsection
