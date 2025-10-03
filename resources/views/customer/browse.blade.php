@extends('customer.layouts.app')

@section('title', 'Browse Products')

@section('content')
  <!-- Category Filter -->
  <div class="flex justify-end mb-6">
    <form method="GET" action="{{ route('customer.browse') }}" class="flex space-x-2">
      <select 
        name="category" 
        onchange="this.form.submit()"
        class="w-64 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
      >
        <option value="">All Categories</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </form>
  </div>

  <!-- Products Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @php
      $cart = session('cart', []);
    @endphp

    @foreach ($products as $product)
      <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
        @if ($product->stock > 0)
          <a href="{{ route('customer.layouts.product_detail', $product->id) }}" class="block">
            <div class="overflow-hidden rounded-t-lg">
                <img src="{{ asset('product/' . $product->product_img) }}" 
                    alt="{{ $product->name }}" 
                    class="w-full h-48 object-cover rounded-t-lg transform transition-transform duration-300 hover:scale-110">
            </div>

            <div class="p-4">
                <h3 class="font-bold text-lg hover:text-red-500">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</p>
                <p class="text-green-600 font-semibold mt-2">KES {{ number_format($product->price) }}</p>
            
          </a>
            {{-- Cart Logic --}}
            @if(isset($cart[$product->id]))
              <!-- Already in Cart -->
              <button class="w-full mt-4 bg-yellow-500 text-white py-2 rounded cursor-not-allowed">
                In Cart
              </button>
            @else
              <!-- Add to Cart Form -->
              <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                  @csrf
                  <button type="submit" 
                          class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded">
                    Add to Cart
                  </button>
              </form>
            @endif
          </div>
        @else
          <img src="{{ asset('product/' . $product->product_img) }}" 
               alt="{{ $product->name }}" 
               class="w-full h-48 object-cover rounded-t-lg opacity-50">
          <div class="p-4">
            <h3 class="font-bold text-lg">{{ $product->name }}</h3>
            <p class="text-sm text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</p>
            <p class="text-green-600 font-semibold mt-2">KES {{ number_format($product->price) }}</p>

            <!-- Out of Stock -->
            <button class="w-full mt-4 bg-gray-400 text-white py-2 rounded cursor-not-allowed" disabled>
              Out of Stock
            </button>
          </div>
        @endif
      </div>
    @endforeach
  </div>
@endsection