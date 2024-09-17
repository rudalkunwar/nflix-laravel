@extends('users.layouts.app')

@section('content')
    <div class="w-full md:w-3/4 xl:w-3/4 p-4 mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-red-600 text-center">
                <i class="ri-error-warning-line text-4xl align-middle"></i> Payment Failed
            </h1>
            <div class="text-center mb-6">
                <p class="text-gray-600 mb-4">
                    <i class="ri-information-line text-xl align-middle mr-2"></i>
                    Your payment was unsuccessful. Please try again or contact support if the issue persists.
                </p>
                <p class="text-gray-500 mb-4">Order ID: <span class="font-semibold">{{ $order->id }}</span></p>
                <p class="text-gray-500 mb-4">Amount: <span class="font-semibold">Rs
                        {{ number_format($order->amount, 2) }}</span></p>
            </div>

            <!-- Retry Button -->
            <div class="flex justify-center items-center">
                <form action="{{ route('user.premium.upgrade.checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" value="premium">
                    <button
                        type="submit"class="bg-blue-500 text-white px-6 py-3 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                        <i class="ri-restart-line mr-2"></i> Retry Payment</button>
                </form>
            </div>
        </div>
    </div>
@endsection
