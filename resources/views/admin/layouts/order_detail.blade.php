@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">📝 Order #{{ $order->id }}</h2>

    <!-- Customer Info -->
    <div class="mb-6">
        <p><strong>Customer:</strong> {{ $order->user->name }}</p>
        <p><strong>Email:</strong> {{ $order->user->email }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Total:</strong> KES {{ number_format($order->total) }}</p>
    </div>

    <!-- Order Items -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <th class="px-6 py-3 text-left">Product</th>
                    <th class="px-6 py-3 text-center">Quantity</th>
                    <th class="px-6 py-3 text-center">Unit Price</th>
                    <th class="px-6 py-3 text-center">Line Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($order->items as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3">{{ $item->product->name }}</td>
                    <td class="px-6 py-3 text-center">{{ $item->quantity }}</td>
                    <td class="px-6 py-3 text-center">KES {{ number_format($item->unit_price) }}</td>
                    <td class="px-6 py-3 text-center">KES {{ number_format($item->line_total) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.layouts.order') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            ← Back to Orders
        </a>
    </div>
</div>
@endsection