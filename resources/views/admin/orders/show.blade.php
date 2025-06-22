@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Order #{{ $order->id }}</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5>User: {{ $order->user->name ?? '-' }} ({{ $order->user->email ?? '' }})</h5>
            <p>
                <strong>Total Amount:</strong> {{ $order->total_amount }} JD <br>
                <strong>Status:</strong> {{ ucfirst($order->order_status) }} <br>
                <strong>Payment:</strong>
                <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'pending' ? 'warning' : 'danger') }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
                <br>
                <strong>Created At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}
            </p>
            <p>
                <strong>Shipping Address:</strong> {{ $order->shipping_address }} <br>
                <strong>Billing Address:</strong> {{ $order->billing_address ?? '-' }}
            </p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Order Items</div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price (JD)</th>
                        <th>Total (JD)</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->product->name ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
