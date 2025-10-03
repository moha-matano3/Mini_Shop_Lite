<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class ProductController extends Controller
{
    public function add_product()
    {
        $data = Category::all();
        return view('admin.layouts.add_product', compact('data'));
    }

    public function product_add(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save product
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->category_id = $request->category;

        if ($request->hasFile('product_img')) {
            $file = $request->file('product_img');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('product'), $filename);
            $product->product_img = $filename;
        }

        $product->save();
        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function display_product()
    {
        $products = Product::with('category')->orderBy('name', 'asc')->get();
        return view('admin.layouts.disp_product', compact('products'));
    }

    public function product_delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    public function edit_product($id)
    {
        $data = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.layouts.edit_product', compact('data', 'categories'));
    }

    public function update_product(Request $request, $id)
    {
        $data = Product::findOrFail($id);
        $data->name = $request->name;
        $data->price = $request->price;
        $data->stock = $request->stock;
        $data->description = $request->description;
        $data->category_id = $request->category;

        if ($request->hasFile('product_img')) {
            $file = $request->file('product_img');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('product'), $filename);
            $data->product_img = $filename;
        }

        $data->save();
        return redirect('/display_product')->with('success', 'Product updated successfully!');
    }

    public function search_filter_product(Request $request)
    {
        $categories = Category::all();

        $query = Product::with('category');

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $products = $query->orderBy('name', 'asc')->get();

        return view('customer.browse', compact('products', 'categories'));
    }

    public function product_detail($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('customer.layouts.product_detail', compact('product'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->product_img,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('customer.browse')->with('success', 'Product added to cart!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        if (!$cart || count($cart) === 0) {
            return redirect()->route('customer.browse')->with('info', 'Your cart is empty!');
        }
        return view('customer.layouts.cart', compact('cart'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Product removed!');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (!$cart || count($cart) === 0) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        foreach ($cart as $id => $item) {
            $product = \App\Models\Product::find($id);

            if ($product) {
                // Check if stock is enough
                if ($product->stock >= $item['quantity']) {
                    // Deduct stock
                    $product->stock -= $item['quantity'];
                    $product->save();
                } else {
                    return redirect()->route('cart.view')
                                    ->with('error', "Not enough stock for {$product->name}.");
                }
            }
        }

        // Clear cart after successful checkout
        session()->forget('cart');

        return redirect()->route('customer.browse')
                        ->with('success', 'Checkout successful! Your order has been placed.');
    }


    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            // Fetch product stock from DB
            $product = \App\Models\Product::find($id);

            if ($request->action === 'increase') {
                // Check if stock allows increment
                if ($cart[$id]['quantity'] < $product->stock) {
                    $cart[$id]['quantity']++;
                } else {
                    return redirect()->route('cart.view')->with('error', 'Not enough stock available.');
                }
            } elseif ($request->action === 'decrease') {
                $cart[$id]['quantity']--;
                if ($cart[$id]['quantity'] <= 0) {
                    unset($cart[$id]); // remove if qty 0
                }
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('cart.view');
    }
}