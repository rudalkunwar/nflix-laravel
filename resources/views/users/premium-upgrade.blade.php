@extends('users.layouts.app')

@section('content')
    <div class="w-full md:w-3/4 xl:w-3/4 p-4 mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Upgrade to Premium</h1>

            <!-- Premium Plan Details -->
            <div class="mb-6">
                <div class="space-y-4">
                    <!-- Premium Plan -->
                    <div class="border border-gray-300 rounded-lg p-4">
                        <h3 class="text-lg font-semibold mb-2">Premium Plan</h3>
                        <p class="text-gray-600 mb-2">Enjoy the best experience with no ads and exclusive content.</p>
                        <p class="text-2xl font-bold mb-4">Rs 2,000 / year</p>
                        <ul class="mb-4">
                            {{-- <li>No ads</li>
                            <li>High-definition (HD)</li>
                            <li>Exclusive content</li> --}}
                            <li><i class="ri-download-fill text-xl px-2"></i>Unlock download feature</li>
                        </ul>
                        <form action="{{ route('user.premium.upgrade.checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" value="premium">
                            <button type="submit"
                                class="bg-blue-500 text-white px-6 py-3 rounded-full w-full flex items-center justify-center hover:bg-blue-600 transition">
                                <i class="ri-lock-line mr-2"></i> Upgrade to Premium
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ route('user.premium') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    <i class="ri-arrow-left-line mr-2"></i> Back to Premium Status
                </a>
            </div>
        </div>
    </div>
@endsection
