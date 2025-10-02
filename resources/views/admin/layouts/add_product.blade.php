@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('content')

    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">🛒 Add a Product</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 p-3 text-green-800 bg-green-100 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-4 p-3 text-red-800 bg-red-100 rounded-md">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('product_add') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Product Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2" 
                       placeholder="Enter product name" required>
            </div>

            <!-- Product Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                <input type="file" name="product_img" 
                       class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                              file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                       placeholder="Enter product price" required>
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                <input type="number" name="stock" value="{{ old('stock') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                       placeholder="Enter stock quantity" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Description</label>
                <textarea name="description" rows="4"
                          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                          placeholder="Enter product description" required>{{ old('description') }}</textarea>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2" 
                        required>
                    <option value="">-- Select a category --</option>
                    @foreach ($data as $cat)
                        <option value="{{ $cat->id }}" {{ old('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md shadow transition">
                    ➕ Add Product
                </button>
            </div>
        </form>
    </div>

@endsection