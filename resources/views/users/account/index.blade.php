@extends('users.account.sidebar')

@section('main')
    <!-- Main Content -->
    <div class="w-full md:w-3/4 xl:w-3/4 p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 flex items-center">
                <i class="ri-user-line text-blue-500 text-3xl mr-2"></i>
                Profile Information
            </h1>

            <!-- Display user basic info -->
            <div class="mb-4 flex items-center">
                <i class="ri-user-fill text-gray-500 text-xl mr-2"></i>
                <div>
                    <label class="font-semibold text-gray-800">Name:</label>
                    <p class="text-gray-700">{{ auth()->user()->name }}</p>
                </div>
            </div>

            <div class="mb-4 flex items-center">
                <i class="ri-mail-fill text-gray-500 text-xl mr-2"></i>
                <div>
                    <label class="font-semibold text-gray-800">Email:</label>
                    <p class="text-gray-700">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <!-- Check if userDetails exists before accessing properties -->
            @if (auth()->user()->userDetails)
                <div class="mb-4 flex items-center">
                    <i class="ri-map-pin-fill text-gray-500 text-xl mr-2"></i>
                    <div>
                        <label class="font-semibold text-gray-800">Address:</label>
                        <p class="text-gray-700">{{ auth()->user()->userDetails->address ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mb-4 flex items-center">
                    <i class="ri-phone-fill text-gray-500 text-xl mr-2"></i>
                    <div>
                        <label class="font-semibold text-gray-800">Phone Number:</label>
                        <p class="text-gray-700">{{ auth()->user()->userDetails->phone_number ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mb-4 flex items-center">
                    <i class="ri-star-fill text-gray-500 text-xl mr-2"></i>
                    <div>
                        <label class="font-semibold text-gray-800">Account Status:</label>
                        <p class="text-gray-700">
                            {{ auth()->user()->userDetails->is_premium ? 'Premium' : 'Regular' }}
                        </p>
                    </div>
                </div>
            @else
                <div class="mb-4">
                    <p class="text-gray-700">User details not available. Complete your profile in Settings.</p>
                </div>
            @endif

            <!-- Edit Profile Link -->
            <div class="text-center flex justify-center">
                <a href="{{ route('user.account.settings') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600 transition w-full">
                    <i class="ri-pencil-fill mr-2"></i>
                    Edit Profile
                </a>
            </div>

        </div>
    </div>
@endsection
