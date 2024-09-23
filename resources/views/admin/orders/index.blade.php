@extends('layouts.app')

@section('content')
<div class="pl-8 shadow-md container mx-auto flex justify-between items-center py-4">
    <h1 class="text-3xl font-bold text-gray-800">Orders</h1>
</div>
    <div class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow-md mb-6 flex items-center">
                <i class="ri-check-circle-line text-green-500 mr-2 text-lg"></i>
                {{ session('success') }}
            </div>
        @endif
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Order ID</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">User</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Amount</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Payment Status</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders->isEmpty())
                        <tr class="text-center">
                            <td colspan="5">No order received yet</td>
                        </tr>
                    @endif
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b border-gray-200">{{ $order->id }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">{{ $order->user->name }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">Rs{{ $order->amount }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span
                                    class="inline-block px-3 py-1 text-sm font-semibold {{ $order->payment_status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} rounded-full">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200 flex space-x-2">
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this order?')"
                                        class="text-red-600 hover:text-red-800 flex items-center space-x-1">
                                        <i class="ri-delete-bin-line"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
