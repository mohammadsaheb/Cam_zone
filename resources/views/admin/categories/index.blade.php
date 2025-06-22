@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Slug</th>
            <th>Image</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ Str::limit($category->description, 30) }}</td>
            <td>{{ $category->slug }}</td>
            <td>
                @if($category->image)
                    <img src="{{ asset('storage/'.$category->image) }}" alt="image" width="40">
                @else
                    -
                @endif
            </td>
            <td>
                @if($category->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td class="text-center">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
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