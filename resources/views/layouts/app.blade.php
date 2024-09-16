<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nflix</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .active {
            background-color: #e2e8f0;
            color: #1f2937;
        }
    </style>
</head>

<body class="flex">
    <!-- Sidebar -->
    <div class="h-screen p-3 space-y-2 w-60 bg-gray-50 text-gray-800 fixed left-0 z-20">
        <div class="flex items-center p-2 space-x-4">
            <img src="https://source.unsplash.com/100x100/?portrait" alt=""
                class="w-12 h-12 rounded-full bg-gray-100">
            <div>
                <h2 class="text-lg font-semibold">Admin</h2>
                <span class="flex items-center space-x-1">
                    <a href="#" class="text-xs hover:underline text-gray-600">View profile</a>
                </span>
            </div>
        </div>
        <div class="divide-y divide-gray-300">
            <ul class="pt-2 pb-4 space-y-1 text-sm">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-100">
                        <i class="ri-dashboard-line w-5 h-5 text-gray-600"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.notifications') ? 'active' : '' }}">
                    <a class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-100">
                        <i class="ri-notification-4-line w-5 h-5 text-gray-600"></i>
                        <span>Notifications</span>
                    </a>
                </li>
            </ul>
            <ul class="pt-4 pb-2 space-y-1 text-sm">
                <li class="{{ request()->routeIs('admin.movies.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.movies.index') }}"
                        class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-100">
                        <i class="ri-movie-2-line w-5 h-5 text-gray-600"></i>
                        <span>Movies</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-100">
                        <i class="ri-list-settings-line w-5 h-5 text-gray-600"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.genres.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.genres.index') }}"
                        class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-100">
                        <i class="ri-sound-module-line w-5 h-5 text-gray-600"></i>
                        <span>Genres</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.casts.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.casts.index') }}"
                        class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-100">
                        <i class="ri-group-line w-5 h-5 text-gray-600"></i>
                        <span>Casts</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.directors.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.directors.index') }}"
                        class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-100">
                        <i class="ri-user-voice-line w-5 h-5 text-gray-600"></i>
                        <span>Directors</span>
                    </a>
                </li>
            </ul>
            <ul class="pt-4 pb-2 space-y-1 text-sm">
                <li class="{{ request()->routeIs('admin.admin.settings') ? 'active' : '' }}">
                    <a href="" class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-100">
                        <i class="ri-settings-3-line w-5 h-5 text-gray-600"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit"
                            class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-100 w-full">
                            <i class="ri-logout-box-line w-5 h-5 text-gray-600"></i>
                            <span>Logout</span>
                        </button>
                    </form>

                </li>
            </ul>
        </div>
    </div>
    <!-- Content -->
    <div class="flex-1 bg-gray-100 p-6 pl-64">
        @yield('content')
    </div>

    @php
        session_start();
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sessionMessage = '<?php echo session('success') ? session('success') : ''; ?>';
            if (sessionMessage) {
                Toastify({
                    text: sessionMessage,
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    stopOnFocus: true,
                }).showToast();
            }
        });
    </script>
</body>

</html>
