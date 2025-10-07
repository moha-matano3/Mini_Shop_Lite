<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    /* 
        Page to display all orders in a table.
        one can search orders by email or name 
    */
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


    /* 
        Show order details by ID 
        data such as user, items and product as loaded in the view
        there is a relationship between order_items and orders and orders
        is already related to uder_id
    */
    public function show_order_detail($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.layouts.order_detail', compact('order'));
    }
}