@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">📂 Categories</h2>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <th class="px-6 py-3 text-left">Category Name</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($category as $cat)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 font-medium text-gray-800">
                        {{ $cat->name }}
                    </td>
                    <td class="px-6 py-3 flex items-center justify-center space-x-3">
                        <!-- Edit Button -->
                        <a href="{{ url('edit_category', $cat->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Edit
                        </a>

                        <!-- Delete Button -->
                        <a href="{{ url('category_delete', $cat->id) }}" 
                           onclick="confirmation(event)"
                           class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
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