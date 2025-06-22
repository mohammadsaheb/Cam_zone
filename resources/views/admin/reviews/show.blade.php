@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Review Details</h2>

    <div class="card">
        <div class="card-header">
            Review #{{ $review->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">
                <strong>User:</strong> {{ $review->user->name ?? 'Unknown' }}
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
                <strong>Product:</strong> {{ $review->product->name ?? 'Unknown' }}
            </h6>
            <p class="card-text">
                <strong>Rating:</strong> {{ $review->rating }} / 5
            </p>
            <p class="card-text">
                <strong>Comment:</strong> <br>
                {{ $review->comment ?: '-' }}
            </p>
            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
