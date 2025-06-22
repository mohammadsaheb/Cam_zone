@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Category</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug *</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            @if($category->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$category->image) }}" alt="image" width="70">
                </div>
            @endif
            <input type="file" name="image" class="form-control">
            <small class="text-muted">Leave blank to keep the current image.</small>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
