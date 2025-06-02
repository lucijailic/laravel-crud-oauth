@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Products</h1>

    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Colors</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? '-' }}</td>
            <td>
                @foreach($product->colors as $color)
                <span class="badge bg-secondary">{{ $color->name }}</span>
                @endforeach
            </td>
            <td>{{ number_format($product->price, 2) }} kn</td>
            <td>
                <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">No products found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection
