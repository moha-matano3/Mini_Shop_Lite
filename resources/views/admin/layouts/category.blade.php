@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">➕ Add a Category</h1>

    <form method="POST" action="{{ url('add_category') }}" class="space-y-5">
        @csrf

        <!-- Category Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                placeholder="Enter category name">
        </div>
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Description</label>
            <input 
                type="text" 
                id="description" 
                name="description" 
                required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                placeholder="Enter Category Description">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                Add Category
            </button>
        </div>
    </form>
    
@endsection