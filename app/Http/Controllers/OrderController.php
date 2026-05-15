<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
     public function index()
    {
        $orders = Order::all()->sortByDesc('created_at');
        return view('customer.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        return view('customer.order.show', compact('order', 'orderItems'));
    }
}
