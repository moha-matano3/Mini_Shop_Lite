@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')

@include('admin.layouts.searchbar')


<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">📦 Orders</h2>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <th class="px-6 py-3 text-left">Customer</th>
                    <th class="px-6 py-3 text-center">Total</th>
                    <th class="px-6 py-3 text-center">Date</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3">{{ $order->user->name }}</td>
                    <td class="px-6 py-3 text-center">KES {{ number_format($order->total) }}</td>
                    <td class="px-6 py-3 text-center">{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-3 text-center">
                        <a href="{{ route('admin.layouts.order_detail', $order->id) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                            Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection