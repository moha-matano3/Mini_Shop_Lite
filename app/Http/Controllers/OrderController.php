<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
     public function order_show()
    {
        // eager load user relation
        $orders = Order::with('user')->latest()->get();
        return view('admin.layouts.order', compact('orders'));
    }

    public function show_order_detail($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.layouts.order_detail', compact('order'));
    }
}
