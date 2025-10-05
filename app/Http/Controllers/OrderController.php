<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_show(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->orWhere('id', $search); // allows searching by order ID
        }

        $orders = $query->get();

        return view('admin.layouts.order', compact('orders'));
    }

    public function show_order_detail($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.layouts.order_detail', compact('order'));
    }
}