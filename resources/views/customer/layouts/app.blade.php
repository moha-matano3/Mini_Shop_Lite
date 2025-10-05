<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'MiniShopLite')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <style>
    .notify-container 
    {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999; /* Ensure it's above other elements */
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navbar --}}
  <nav class="bg-white shadow-md fixed w-full top-0 z-20">
    <div class="container mx-auto flex items-center justify-between px-6 py-3">
      
      <!-- Logo -->
      <a href="{{ route('customer.browse') }}" class="flex items-center gap-2">
        <span class="font-bold text-xl text-gray-800">MiniShopLite</span>
      </a>

      <!-- Search Bar -->
      <form method="GET" action="{{ route('customer.browse') }}" class="flex w-1/2">
        <input 
          type="text" 
          name="search" 
          placeholder="Search products..."
          value="{{ request('search') }}"
          class="flex-1 px-4 py-2 rounded-l-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none"
        >
        <button type="submit" class="px-4 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">
          🔍
        </button>
      </form>

      <!-- Actions -->
      <div class="flex items-center gap-4">
      @php
        $cart = session('cart', []);
        $cartCount = is_array($cart) ? count($cart) : 0;
      @endphp

      @if($cartCount > 0)
        <!-- Cart with items -->
        <a href="{{ route('cart.view') }}" class="relative text-gray-600 hover:text-gray-900">
          <i class="fas fa-shopping-cart text-xl"></i>
          <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1 rounded-full">
            {{ $cartCount }}
          </span>
        </a>
      @else
        <!-- Disabled / empty cart -->
        <span class="relative text-gray-400 cursor-not-allowed">
          <i class="fas fa-shopping-cart text-xl"></i>
          <span class="absolute -top-2 -right-2 bg-gray-400 text-white text-xs px-1 rounded-full">
            0
          </span>
        </span>
      @endif

        <!-- User -->
        <a href="#" class="text-gray-600 hover:text-gray-900">
          <i class="fa fa-user text-xl"></i>
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md">
            Logout
          </button>
        </form>
      </div>
    </div>
  </nav>

  <div class="notify-container">
    <x-notify::notify />
  </div>

  {{-- Main Content --}}
  <main class="flex-1 container mx-auto px-6 mt-28">
    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="bg-gray-900 text-gray-400 text-center py-6 mt-10">
    <p>&copy; {{ date('Y') }} MiniShopLite. All Rights Reserved.</p>
  </footer>

  <x-notify::notify />
    @notifyJs

</body>
</html>