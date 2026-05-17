<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

    $orders = Order::all()->sortByDesc('created_at');
    // $totalOrders = Order::count();
    // $totalRevenue = Order::sum('grand_total');

    // rekapan harian
    $todayOrders = Order::whereDate('created_at', now())->count();
    $todayRevenue = Order::whereDate('created_at', now())->sum('total');
    $todayProfit = Order::whereDate('created_at', now())->sum('profit');

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

    return view('customer.dashboard', compact('todayOrders', 'todayRevenue','todayProfit','weeklyOrders', 'weeklyRevenue', 'weeklyProfit', 'monthlyOrders', 'monthlyProfit', 'monthlyRevenue', 'orders', 'topProducts','lowStocks',));
    }

    public function dailyOrders()
    {
        $orders = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->limit(5)
            ->get();

        return response()->json([
            'labels' => $orders->pluck('date')->map(function($date) {
                return Carbon::parse($date)->format('d-M-Y');
            }),
            'data' => $orders->pluck('total')
        ]);
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
