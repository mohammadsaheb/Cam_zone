@extends('layouts.admin')
@section('content')
<h2>Orders</h2>
<table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Total</th>
            <th>Status</th>
            <th>Payment</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name ?? '-' }}</td>
            <td>{{ $order->total_amount }} JD</td>
            <td>
                <span class="badge bg-{{ $order->order_status == 'delivered' ? 'success' : ($order->order_status == 'cancelled' ? 'danger' : 'secondary') }}">
                    {{ ucfirst($order->order_status) }}
                </span>
            </td>
            <td>
                <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'pending' ? 'warning' : 'danger') }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </td>
            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
            <td>
                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm">Show</a>
                <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
