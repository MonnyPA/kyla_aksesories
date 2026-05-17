<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

    $user = Auth::user();

    if (
        $user->role->role_name == 'cashier_kd' ||
        $user->role->role_name == 'cashier_osm'
    ) {

        $orders = Order::with('user')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

    } else {

        $orders = Order::with('user')
            ->latest()
            ->get();
    }
    // $totalOrders = Order::count();
    // $totalRevenue = Order::sum('grand_total');

    // rekapan harian
    $todayOrders = Order::whereDate('created_at', now())->count();
    $todayRevenue = Order::whereDate('created_at', now())->sum('total');
    $todayProfit = Order::whereDate('created_at', now())->sum('profit');

    $restrictedRoles = ['cashier_kd', 'cashier_osm'];

    $query = Order::query();

    // Jika cashier, hanya lihat transaksi miliknya
    if (in_array($user->role->role_name, $restrictedRoles)) {
        $query->where('user_id', $user->id);
    }

    /*
    |--------------------------------------------------------------------------
    | Revenue Harian
    |--------------------------------------------------------------------------
    */
    $todayRevenueByUser = (clone $query)
        ->whereDate('created_at', now())
        ->sum('total');

    /*
    |--------------------------------------------------------------------------
    | Revenue Mingguan
    |--------------------------------------------------------------------------
    */
    $weeklyRevenueByUser = (clone $query)
        ->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])
        ->sum('total');

    /*
    |--------------------------------------------------------------------------
    | Revenue Bulanan
    |--------------------------------------------------------------------------
    */
    $monthlyRevenueByUser = (clone $query)
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('total');

    /*
    |--------------------------------------------------------------------------
    | Revenue Harian By Cashier
    |--------------------------------------------------------------------------
    */
    $dailyRevenueByToko = Order::with('user')
        ->whereDate('created_at', now())
        ->whereHas('user.role', function ($query) {
            $query->whereIn('role_name', ['cashier_osm', 'cashier_kd']);
        })
        ->selectRaw('user_id, SUM(total) as total_revenue')
        ->groupBy('user_id')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Revenue Mingguan By Cashier
    |--------------------------------------------------------------------------
    */
    $weeklyRevenueByToko = Order::with('user')
        ->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])
        ->whereHas('user.role', function ($query) {
            $query->whereIn('role_name', ['cashier_osm', 'cashier_kd']);
        })
        ->selectRaw('user_id, SUM(total) as total_revenue')
        ->groupBy('user_id')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Revenue Bulanan By Cashier
    |--------------------------------------------------------------------------
    */
    $monthlyRevenueByToko = Order::with('user')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->whereHas('user.role', function ($query) {
            $query->whereIn('role_name', ['cashier_osm', 'cashier_kd']);
        })
        ->selectRaw('user_id, SUM(total) as total_revenue')
        ->groupBy('user_id')
        ->get();

    // rekapan bulanan
    $monthlyOrders = Order::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->count();

    $monthlyRevenue = Order::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->sum('total');

    $monthlyProfit = Order::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->sum('profit');

    // rekepan mingguan
    $weeklyOrders = Order::whereBetween('created_at', [
        now()->startOfWeek(),
        now()->endOfWeek()
    ])->count();

    $weeklyRevenue = Order::whereBetween('created_at', [
        now()->startOfWeek(),
        now()->endOfWeek()
    ])->sum('total');

    $weeklyProfit = Order::whereBetween('created_at', [
        now()->startOfWeek(),
        now()->endOfWeek()
    ])->sum('profit');

    $topProducts = OrderItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_sold')
            )
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

    $lowStocks = Product::orderBy('stock', 'ASC')
        ->limit(5)
        ->get();

    return view('customer.dashboard', compact('todayOrders', 'todayRevenue','todayProfit','weeklyOrders', 'weeklyRevenue', 'weeklyProfit', 'monthlyOrders', 'monthlyProfit', 'monthlyRevenue', 'orders', 'topProducts','lowStocks', 'monthlyRevenueByUser', 'weeklyRevenueByUser', 'todayRevenueByUser','dailyRevenueByToko','weeklyRevenueByToko','monthlyRevenueByToko'));
    }

    public function dailyOrders()
    {
        $user = Auth::user();

        $restrictedRoles = ['cashier_kd', 'cashier_osm'];

        $query = Order::query();

        // Jika cashier, tampilkan hanya order miliknya
        if (in_array($user->role->role_name, $restrictedRoles)) {

            $query->where('user_id', $user->id);
        }

        $orders = $query
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return response()->json([
            'labels' => $orders->pluck('date')
                ->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M')),

            'data' => $orders->pluck('total')
        ]);


        // $orders = Order::select(
        //         DB::raw('DATE(created_at) as date'),
        //         DB::raw('SUM(total) as total')
        //     )
        //     ->groupBy('date')
        //     ->orderBy('date', 'ASC')
        //     ->limit(5)
        //     ->get();

        // return response()->json([
        //     'labels' => $orders->pluck('date')->map(function($date) {
        //         return Carbon::parse($date)->format('d-M-Y');
        //     }),
        //     'data' => $orders->pluck('total')
        // ]);
    }

    public function dailyRevenue()
    {
        $revenues = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->limit(5)
            ->get();

        return response()->json([
            'labels' => $revenues->pluck('date'),
            'data' => $revenues->pluck('total')
        ]);
    }

}
