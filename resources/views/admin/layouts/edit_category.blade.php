@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Update Category</h1>

    <form method="POST" action="{{ url('update_category', $data->id) }}" class="space-y-5">
        @csrf

        <!-- Category Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $data->name) }}"
                required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                placeholder="Enter category name">
        </div>

        <!-- Category Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Category Description</label>
            <input 
                type="text" 
                id="description" 
                name="description" 
                value="{{ old('description', $data->description) }}"
                required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                placeholder="Enter category description">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                Update Category
            </button>
        </div>
    </form>
    
@endsection