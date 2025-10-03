@extends('customer.layouts.app')

@section('title', $product->name)

@section('content')
  <div class="bg-white shadow rounded-lg p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

      <!-- Product Image -->
      <div>
        <img src="{{ asset('product/' . $product->product_img) }}" 
             alt="{{ $product->name }}" 
             class="w-full h-[450px] object-cover rounded-md">
      </div>

      <!-- Product Info -->
      <div>
        <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
        <p class="text-sm text-gray-500 mb-4">
          Category: <span class="font-medium">{{ $product->category->name ?? 'Uncategorized' }}</span>
        </p>
        <p class="text-2xl text-green-600 font-semibold mb-6">
          KES {{ number_format($product->price) }}
        </p>
        <p class="text-gray-700 mb-6 leading-relaxed">
          {{ $product->description }}
        </p>
        @if ($product->stock > 0)
          <a href="#" 
             class="block w-full bg-green-600 text-white text-center py-3 rounded-md font-medium hover:bg-green-700 transition">
            Add to Cart
          </a>
        @else
          <button disabled 
             class="block w-full bg-gray-400 text-white text-center py-3 rounded-md font-medium cursor-not-allowed">
            Out of Stock
          </button>
        @endif
      </div>
    </div>
  </div>
@endsection