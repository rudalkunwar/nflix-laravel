@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-md shadow-md mb-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold flex items-center space-x-2">
            <i class="ri-user-line text-gray-600"></i>
            <span>Users</span>
        </h2>
    </div>
    <div class="bg-white p-4 rounded-md shadow-md">
        <table class="w-full border-collapse bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Premium</th>
                    <th class="py-3 px-4 text-left">Email Verified</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            @if ($user->userDetails->is_premium)
                                <span class="text-green-500 font-semibold">Yes</span>
                            @else
                                <span class="text-red-500 font-semibold">No</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            @if ($user->email_verified_at)
                                <span class="text-green-500 font-semibold">Verified</span>
                            @else
                                <span class="text-red-500 font-semibold">Not Verified</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure to delete this user?')" type="submit"
                                        class="text-red-500 hover:text-red-700 flex items-center space-x-1">
                                        <i class="ri-delete-bin-line"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-3 px-4 text-center text-gray-500">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
