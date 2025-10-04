<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderApiController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        // Check if user is authenticated (since this route will use auth:sanctum)
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.'
            ], 401);
        }

        $totalAmount = 0;

        // Create an empty order first
        $order = Order::create([
            'user_id' => $user->id,
            'total' => 0 // placeholder, updated after line totals
        ]);

        foreach ($validated['items'] as $item) {
            $product = Product::find($item['product_id']);

            // Check stock
            if ($product->stock < $item['quantity']) {
                return response()->json([
                    'success' => false,
                    'message' => "Not enough stock for {$product->name}."
                ], 400);
            }

            // Calculate totals
            $lineTotal = $product->price * $item['quantity'];
            $totalAmount += $lineTotal;

            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'line_total' => $lineTotal,
            ]);

            // Reduce stock
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Update order total
        $order->update(['total' => $totalAmount]);

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully.',
            'order' => [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'total' => $order->total,
                'created_at' => $order->created_at->toDateTimeString(),
                'items' => $order->items()->with('product')->get()
            ]
        ], 201);
    }
}