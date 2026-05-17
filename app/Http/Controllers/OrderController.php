<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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

            return view('customer.order.index', compact('orders'));
        }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        return view('customer.order.show', compact('order', 'orderItems'));
    }
}
