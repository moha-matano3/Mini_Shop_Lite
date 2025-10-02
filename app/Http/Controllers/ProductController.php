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
}