@extends('layouts.app')

@section('content')
    <div class="pl-8 shadow-md container mx-auto flex justify-between items-center py-4">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    </div>

    <div class="grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 sm:px-8">

        <!-- Total Users -->
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-green-500">
                <i class="ri-user-line ri-2x text-white"></i>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Total Users</h3>
                <p class="text-3xl">{{ $users }}</p>
            </div>
        </div>

        <!-- Total Movies -->
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-blue-500">
                <i class="ri-film-line ri-2x text-white"></i>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Total Movies</h3>
                <p class="text-3xl">{{ $movies }}</p>
            </div>
        </div>

        <!-- Total Genres -->
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-indigo-500">
                <i class="ri-play-list-line ri-2x text-white"></i>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Total Genres</h3>
                <p class="text-3xl">{{ $genres }}</p>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-yellow-500">
                <i class="ri-folder-line ri-2x text-white"></i>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Total Categories</h3>
                <p class="text-3xl">{{ $categories }}</p>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-orange-500">
                <i class="ri-money-dollar-circle-line ri-2x text-white"></i>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Monthly Revenue</h3>
                <p class="text-3xl">Rs {{ number_format($monthlyRevenue, 2) }}</p>
            </div>
        </div>

        <!-- New Movies This Month -->
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-purple-500">
                <i class="ri-film-line ri-2x text-white"></i>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">New Movies This Month</h3>
                <p class="text-3xl">{{ $newMoviesThisMonth }}</p>
            </div>
        </div>

        <!-- Top Genre -->
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-pink-500">
                <i class="ri-star-line ri-2x text-white"></i>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Top Genre</h3>
                <p class="text-lg">{{ $topGenre?->name }} ({{ $topGenre?->movies_count }} movies)</p>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="mt-8 mx-4 sm:mx-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Monthly Revenue Overview</h2>
        <canvas id="revenueChart" height="100"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx, {
            type: 'line', 
            data: {
                labels: @json($months), 
                datasets: [{
                    label: 'Revenue',
                    data: @json($formattedSalesData), 
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)', 
                    borderWidth: 1, 
                    fill: true, 
                }]
            },
            options: {
                responsive: true, 
                scales: {
                    y: {
                        beginAtZero: true 
                    }
                }
            }
        });
    </script>
    
@endsection
