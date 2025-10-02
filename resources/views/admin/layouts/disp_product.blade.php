@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">🛒 Products</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-3 text-green-800 bg-green-100 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <th class="px-6 py-3 text-left">Product Name</th>
                    <th class="px-6 py-3 text-center">Image</th>
                    <th class="px-6 py-3 text-center">Price</th>
                    <th class="px-6 py-3 text-center">Stock</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($products as $product)
                <tr class="hover:bg-gray-50">
                    <!-- Product Name -->
                    <td class="px-6 py-3 font-medium text-gray-800">{{ $product->name }}</td>

                    <!-- Product Image -->
                    <td class="px-6 py-3 text-center">
                        <img src="{{ asset('product/' . $product->product_img) }}" 
                             alt="{{ $product->name }}" 
                             class="w-16 h-16 object-cover rounded-md mx-auto shadow">
                    </td>

                    <!-- Price -->
                    <td class="px-6 py-3 text-center text-green-600 font-semibold">
                        Ksh {{ number_format($product->price, 2) }}
                    </td>

                    <!-- Stock -->
                    <td class="px-6 py-3 text-center">
                        <span class="px-3 py-1 rounded-full text-xs 
                                    {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->stock > 0 ? $product->stock . ' In Stock' : 'Out of Stock' }}
                        </span>
                    </td>

                    <!-- Description -->
                    <td class="px-6 py-3 text-gray-600">{{ Str::limit($product->description, 50) }}</td>

                    <!-- Category -->
                    <td class="px-6 py-3 text-gray-800">
                        {{ $product->category ? $product->category->name : 'Uncategorized' }}
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-3 flex items-center justify-center space-x-3">
                        <!-- Edit Button -->
                        <a href="{{ url('edit_product', $product->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow">
                            Edit
                        </a>

                        <!-- Delete Button -->
                        <a href="{{ url('product_delete', $product->id) }}" 
                           onclick="confirmation(event)"
                           class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow">
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection