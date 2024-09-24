@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="pl-8 shadow-md container mx-auto flex justify-between items-center py-4">
        <h1 class="text-3xl font-bold text-gray-800">Feedback Notifications</h1>
    </div>

    <!-- Notification Section -->
    <div class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow-md mb-6 flex items-center">
                <i class="ri-check-circle-line text-green-500 mr-2 text-lg"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Notifications Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">SN</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">User</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Feedback Message</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($notifications->isEmpty())
                        <tr class="text-center">
                            <td colspan="4" class="py-3 px-4 text-gray-600">No feedback notifications yet</td>
                        </tr>
                    @endif

                    @foreach ($notifications as $notification)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b border-gray-200">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">{{ $notification->user->name }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">{{ $notification->message }}</td>
                            <td class="py-3 px-4 border-b border-gray-200 flex space-x-2">
                                <form action="{{ route('admin.notification.destroy', $notification->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this notification?')"
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

    </div>
@endsection
