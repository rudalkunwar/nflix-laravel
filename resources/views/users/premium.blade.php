@extends('users.layouts.app')

@section('content')
    @if (!auth()->user()->userDetails)
        <div class="h-screen flex items-center justify-center bg-gray-100">
            <div class="bg-white shadow-md rounded-lg p-6 max-w-md w-full text-center">
                <h2 class="text-xl font-bold mb-4">Profile Update Required</h2>
                <p class="text-gray-600 mb-4">Please update your profile information to access premium features.</p>
                <a href="{{ route('user.account.settings') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    <i class="ri-user-line mr-2"></i> Update Profile
                </a>
            </div>
        </div>
    @else
        <div class="w-full md:w-3/4 xl:w-3/4 p-4 mx-auto">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Premium Membership</h1>

                @if (auth()->user()->userDetails->is_premium)
                    <div class="text-center mb-6">
                        <i class="ri-star-line text-yellow-400 text-4xl mb-4"></i>
                        <p class="text-green-600 font-semibold">You are currently a Premium member!</p>
                        <p>Your subscription is valid until
                            {{ auth()->user()->userDetails->premium_expiry_date->format('F j, Y') }}.</p>
                    </div>
                @else
                    <div class="text-center mb-6">
                        <i class="ri-star-line text-gray-400 text-4xl mb-4"></i>
                        <p class="text-red-600 font-semibold mb-4">Not a Premium member.</p>
                        <p class="text-gray-600">Upgrade to enjoy exclusive features and benefits.</p>
                    </div>
                @endif

                <!-- Features List -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold mb-4">Premium Features</h2>
                    <ul class="list-disc pl-5 space-y-3">
                        <li class="flex items-center">
                            <i class="ri-download-line text-blue-500 text-xl mr-3"></i>
                            <span>Download movies for offline viewing</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-play-circle-line text-blue-500 text-xl mr-3"></i>
                            <span>Ad-free streaming experience</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-speed-line text-blue-500 text-xl mr-3"></i>
                            <span>Access to high-definition (HD) content</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-star-line text-blue-500 text-xl mr-3"></i>
                            <span>Exclusive access to new releases</span>
                        </li>
                    </ul>
                </div>

                @if (auth()->user()->userDetails->is_premium)
                    <!-- Upgrade/Downgrade Form -->
                    <form
                        action="{{ auth()->user()->userDetails->is_premium ? route('user.premium.cancel') : route('user.premium.upgrade') }}"
                        method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white px-6 py-3 rounded-full w-full flex items-center justify-center hover:bg-red-600 transition">
                            <i class="ri-lock-unlock-line mr-2"></i> Cancel Premium Membership
                        </button>
                    </form>
                @else
                    <a href="{{ route('user.premium.upgrade') }}"
                        class="bg-blue-500 text-white px-6 py-3 rounded-full w-full flex items-center justify-center hover:bg-blue-600 transition">
                        <i class="ri-lock-line mr-2"></i> Upgrade to Premium
                    </a>
                @endif
            </div>
        </div>
    @endif
@endsection
