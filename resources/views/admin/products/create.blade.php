@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Add Product</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Product Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description *</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label class="form-label">Price (JD) *</label>
                <input type="number" name="price" class="form-control" step="0.01" min="0" value="{{ old('price') }}" required>
            </div>
            <div class="col">
                <label class="form-label">Quantity *</label>
                <input type="number" name="quantity" class="form-control" min="0" value="{{ old('quantity', 0) }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Category *</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Brand *</label>
            <select name="brand" class="form-select" required>
                <option value="Canon" {{ old('brand')=='Canon' ? 'selected' : '' }}>Canon</option>
                <option value="Nikon" {{ old('brand')=='Nikon' ? 'selected' : '' }}>Nikon</option>
                <option value="Sony" {{ old('brand')=='Sony' ? 'selected' : '' }}>Sony</option>
                <option value="Other" {{ old('brand')=='Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">Featured</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
@endsection
