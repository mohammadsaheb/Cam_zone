@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Products</h2>

    {{-- زر إضافة منتج --}}
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
    </div>

    {{-- الجدول --}}
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Active</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>{{ $product->brand }}</td>
                <td>{{ $product->price }} JD</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>{{ $product->images->count() }}</td>
               <td class="text-center">
                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info btn-sm" title="Show">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
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
</div>
@endsection
