@extends('users.layouts.app')

@section('content')
    <style>
        .active {
            color: rgb(43, 43, 213);
        }
    </style>
    <!-- wrapper -->
    <div class="container p-4 pt-6 pb-16 flex flex-wrap -mx-4">
        <!-- User Info -->
        <div class="w-full md:w-1/4 xl:w-1/4 p-4">
            <div class="bg-white shadow-md rounded p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if (auth()->user()->userDetails && auth()->user()->userDetails->photo)
                            <img src="{{ Storage::url('user_photos/' . auth()->user()->userDetails->photo) }}"
                                alt="Profile Photo" class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
                        @else
                            <img src="{{ asset('user-avatar.png') }}" alt="Default Avatar"
                                class="w-14 h-14 border border-gray-200 p-1 object-cover">
                        @endif
                    </div>
                    <div class="flex-grow pl-4">
                        <p class="text-gray-600">Hello,</p>
                        <h4 class="text-gray-800 font-medium">{{ auth()->user()->name }}</h4>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <div class="bg-white shadow-md rounded p-4 mt-6">
                <nav class="flex flex-col">
                    <!-- Manage Account Section -->
                    <div class="section mb-4">
                        <h5 class="uppercase text-gray-600 mb-2">Manage Account</h5>
                        <a href="{{ route('user.account.profile') }}"
                            class="block py-2 px-4 transition {{ request()->routeIs('user.account.profile') ? 'bg-gray-100 text-blue-600' : '' }}">
                            <i class="ri-profile-line sidebar-icon mr-2"></i>
                            Profile Information
                        </a>
                        <a href="{{ route('user.account.settings') }}"
                            class="block py-2 px-4 transition {{ request()->routeIs('user.account.settings') ? 'bg-gray-100 text-blue-600' : '' }}">
                            <i class="ri-user-line sidebar-icon mr-2"></i>
                            Account Settings
                        </a>
                        <a href="{{ route('user.account.change-password') }}"
                            class="block py-2 px-4 transition {{ request()->routeIs('user.account.change-password') ? 'bg-gray-100 text-blue-600' : '' }}">
                            <i class="ri-lock-line sidebar-icon mr-2"></i>
                            Change Password
                        </a>
                    </div>
                    <!-- Logout Section -->
                    <div class="section">
                        <form action="{{ route('user.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="block py-2 px-4 transition">
                                <i class="ri-logout-box-line sidebar-icon mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
        @yield('main')
    </div>
@endsection
