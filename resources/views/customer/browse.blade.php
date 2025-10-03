@extends('customer.layouts.app')

@section('title', 'Browse Products')

@section('content')
  <!-- Category Filter -->
  <div class="flex justify-end mb-6">
    <form method="GET" action="{{ route('customer.browse') }}" class="flex space-x-2">
      <select name="category" class="border border-gray-300 rounded px-3 py-2">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Filter
      </button>
    </form>
  </div>

  <!-- Products Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach ($products as $product)
      <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
        @if ($product->stock > 0)
          <a href="{{ route('customer.layouts.product_detail', $product->id) }}">
            <img src="{{ asset('product/' . $product->product_img) }}" alt="{{ $product->name }}" 
                 class="w-full h-48 object-cover rounded-t-lg">
          </a>
          <div class="p-4">
            <h3 class="font-bold text-lg">{{ $product->name }}</h3>
            <p class="text-sm text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</p>
            <p class="text-green-600 font-semibold mt-2">KES {{ number_format($product->price) }}</p>
            <a href="#" class="mt-4 block w-full bg-green-600 text-white text-center py-2 rounded hover:bg-green-700">
              Add to Cart
            </a>
          </div>
        @else
          <img src="{{ asset('product/' . $product->product_img) }}" alt="{{ $product->name }}" 
               class="w-full h-48 object-cover rounded-t-lg opacity-50">
          <div class="p-4">
            <h3 class="font-bold text-lg">{{ $product->name }}</h3>
            <p class="text-sm text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</p>
            <p class="text-green-600 font-semibold mt-2">KES {{ number_format($product->price) }}</p>
            <span class="inline-block mt-2 bg-red-500 text-white text-xs px-2 py-1 rounded">Out of Stock</span>
            <button disabled class="mt-4 block w-full bg-gray-400 text-white py-2 rounded">
              Add to Cart
            </button>
          </div>
        @endif
      </div>
    @endforeach
  </div>
@endsection