@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Review</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> Please check the fields below.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select class="form-select" name="user_id" id="user_id" required>
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $review->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select class="form-select" name="product_id" id="product_id" required>
                <option value="">Select Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $review->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" min="1" max="5" class="form-control" id="rating" name="rating"
                   value="{{ old('rating', $review->rating) }}" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea class="form-control" name="comment" id="comment" rows="3">{{ old('comment', $review->comment) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Review</button>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
