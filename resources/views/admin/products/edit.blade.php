@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Edit Product #{{ $product->id }}</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Product Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description *</label>
            <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label class="form-label">Price (JD) *</label>
                <input type="number" name="price" class="form-control" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="col">
                <label class="form-label">Quantity *</label>
                <input type="number" name="quantity" class="form-control" min="0" value="{{ old('quantity', $product->quantity) }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Category *</label>
            <select name="category_id" class="form-select" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Brand *</label>
            <select name="brand" class="form-select" required>
                <option value="Canon" {{ old('brand', $product->brand)=='Canon' ? 'selected' : '' }}>Canon</option>
                <option value="Nikon" {{ old('brand', $product->brand)=='Nikon' ? 'selected' : '' }}>Nikon</option>
                <option value="Sony" {{ old('brand', $product->brand)=='Sony' ? 'selected' : '' }}>Sony</option>
                <option value="Other" {{ old('brand', $product->brand)=='Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">Featured</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Add More Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
    <hr>
    <h5>Current Images</h5>
    <div class="row">
        @foreach($product->images as $image)
            <div class="col-md-2 mb-3">
                <img src="{{ asset('storage/'.$image->image_path) }}" class="img-thumbnail">
                <form action="{{ route('admin.product-images.destroy', $image) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger mt-1" onclick="return confirm('Delete this image?')">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
