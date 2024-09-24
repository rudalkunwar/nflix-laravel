@extends('users.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto pl-6 py-4 flex items-center gap-3">
        <a href="{{ route('user.home') }}" class="text-blue-600 text-lg">
            <i class="ri-home-line"></i>
        </a>
        <span class="text-gray-500">/</span>
        <span class="text-gray-600 font-semibold text-base">Feedback</span>
    </div>

    <!-- Feedback Section -->
    <div class="w-full py-8 flex justify-center">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 bg-blue-100">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">We value your feedback!</h2>

            <form method="POST" action="{{ route('user.feedback.store') }}" class="space-y-6 ">
                @csrf
                <div class="mb-6">
                    <textarea
                        class="w-full h-32 shadow-md border border-gray-300 rounded-lg py-3 px-4 placeholder-gray-500 text-gray-800 focus:outline-none focus:border-blue-500 transition duration-200"
                        placeholder="Share your thoughts with us..." name="message" required></textarea>
                </div>

                <div class="w-full text-center">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-500 hover:to-blue-600 text-white font-semibold py-3 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                        Submit Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
