<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    
    public function index()
    {
        $products = Product::select('id', 'name', 'price', 'stock', 'description', 'product_img')
            ->with('category:id,name')
            ->orderBy('name', 'asc')
            ->get();

        // Transform the response for cleaner API output
        $formatted = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'stock' => (int) $product->stock,
                'description' => $product->description,
                'category' => $product->category->name ?? 'Uncategorized',
                'image_url' => $product->product_img 
                    ? asset('product/' . $product->product_img) 
                    : null,
            ];
        });

        return response()->json([
            'success' => true,
            'count' => $formatted->count(),
            'products' => $formatted,
        ], 200);
    }
}