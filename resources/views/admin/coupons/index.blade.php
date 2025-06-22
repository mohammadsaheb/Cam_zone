@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Coupons</h2>
    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">Add Coupon</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Code</th>
            <th>Type</th>
            <th>Value</th>
            <th>Min Order</th>
            <th>Valid From</th>
            <th>Valid To</th>
            <th>Usage Limit</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($coupons as $coupon)
        <tr>
            <td>{{ $coupon->code }}</td>
            <td>{{ ucfirst($coupon->type) }}</td>
            <td>
                {{ $coupon->type == 'percent' ? $coupon->value . '%' : $coupon->value . ' JD' }}
            </td>
            <td>{{ $coupon->min_order_amount ?? '-' }}</td>
            <td>{{ $coupon->valid_from }}</td>
            <td>{{ $coupon->valid_to }}</td>
            <td>{{ $coupon->usage_limit ?? '-' }}</td>
            <td>
                @if($coupon->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td class="text-center">
                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-warning btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection