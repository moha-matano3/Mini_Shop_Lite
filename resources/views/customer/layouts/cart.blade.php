@extends('customer.layouts.app')

@section('title', 'Your Cart')

@section('content')
  <div class="container mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Your Cart</h2>

    {{-- Flash error for stock issues --}}
    @if(session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif

    @if($cart && count($cart) > 0)
      <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-2 text-left">Image</th>
              <th class="px-4 py-2 text-left">Product</th>
              <th class="px-4 py-2 text-left">Price</th>
              <th class="px-4 py-2 text-center w-32">Qty</th>
              <th class="px-4 py-2 text-left">Subtotal</th>
              <th class="px-4 py-2"></th>
            </tr>
          </thead>
          <tbody>
            @php $total = 0; @endphp
            @foreach ($cart as $id => $item)
              @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
              <tr class="border-t">
                <td class="px-4 py-3">
                  <img src="{{ asset('product/'.$item['image']) }}" class="h-12 w-12 object-cover rounded">
                </td>
                <td class="px-4 py-3 font-medium">{{ $item['name'] }}</td>
                <td class="px-4 py-3">KES {{ number_format($item['price']) }}</td>
                <td class="px-4 py-3 text-center">
                  <div class="flex justify-center items-center space-x-2">
                    <form action="{{ route('cart.update', $id) }}" method="POST">
                      @csrf
                      <button type="submit" name="action" value="decrease" 
                              class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">-</button>
                    </form>
                    <span>{{ $item['quantity'] }}</span>
                    <form action="{{ route('cart.update', $id) }}" method="POST">
                      @csrf
                      <button type="submit" name="action" value="increase" 
                              class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
                    </form>
                  </div>
                </td>
                <td class="px-4 py-3">KES {{ number_format($subtotal) }}</td>
                <td class="px-4 py-3 text-center">
                  <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                      Remove
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
            <tr class="border-t font-semibold">
              <td colspan="4" class="px-4 py-3 text-right">Total:</td>
              <td class="px-4 py-3">KES {{ number_format($total) }}</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>

      <form action="{{ route('cart.checkout') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" 
                class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded">
          Checkout
        </button>
      </form>
    @else
      <div class="bg-white shadow rounded-lg p-6 text-center">
        <p class="text-gray-600 text-lg">🛒 Your cart is empty.</p>
        <a href="{{ route('customer.browse') }}" 
           class="mt-4 inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
          Browse Products
        </a>
      </div>
    @endif
  </div>
@endsection