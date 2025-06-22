@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Edit Order #{{ $order->id }}</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Order Status *</label>
            <select name="order_status" class="form-select">
                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Payment Status *</label>
            <select name="payment_status" class="form-select">
                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Shipping Address *</label>
            <input type="text" name="shipping_address" class="form-control" value="{{ $order->shipping_address }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Billing Address</label>
            <input type="text" name="billing_address" class="form-control" value="{{ $order->billing_address }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Tracking Number</label>
            <input type="text" name="tracking_number" class="form-control" value="{{ $order->tracking_number }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Order</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
