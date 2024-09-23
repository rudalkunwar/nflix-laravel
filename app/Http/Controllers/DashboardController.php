<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::where('role', '!=', 'admin')->count();
        $movies = Movie::count();
        $genres = Genre::count();
        $categories = Category::count();
        $monthlyRevenue = Order::whereMonth('created_at', now()->month)->sum('amount');
        $newMoviesThisMonth = Movie::whereMonth('created_at', Carbon::now()->month)->count();
        $topGenre = Genre::withCount('movies')
            ->orderBy('movies_count', 'desc')
            ->first();
        $salesData = DB::table('orders')
            ->select(
                DB::raw('SUM(amount) as total_sales'),
                DB::raw('strftime("%Y-%m", created_at) as month')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_sales', 'month')
            ->toArray();

        $formattedSalesData = [];
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthLabel = date("Y-m", mktime(0, 0, 0, $i, 1));
            $months[] = $monthLabel;

            $formattedSalesData[] = isset($salesData[$monthLabel]) ? $salesData[$monthLabel] : 0;
        }
        return view('admin.dashboard', compact(
            'users',
            'movies',
            'genres',
            'categories',
            'monthlyRevenue',
            'newMoviesThisMonth',
            'topGenre',
            'salesData',
            'months',
            'formattedSalesData'
        ));
    }

    public function orders()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }
    public function deleteOrders($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
