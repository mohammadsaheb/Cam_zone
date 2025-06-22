@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Reviews</h2>
    
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>User</th>
            <th>Product</th>
            <th>Rating</th>
            <th>Comment</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($reviews as $review)
        <tr>
            <td>{{ $review->user->name ?? '-' }}</td>
            <td>{{ $review->product->name ?? '-' }}</td>
            <td>{{ $review->rating }}</td>
            <td>{{ $review->comment }}</td>
            <td class="text-center">
                <!-- <a href="{{ route('admin.reviews.show', $review) }}" class="btn btn-info btn-sm" title="View">
                    <i class="fas fa-eye"></i>
                </a> -->
                <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-warning btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display:inline;">
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