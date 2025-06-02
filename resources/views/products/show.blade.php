@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Product Details</h1>

    <div class="mb-3"><strong>Name:</strong> {{ $product->name }}</div>
    <div class="mb-3"><strong>Description:</strong> {{ $product->description }}</div>
    <div class="mb-3"><strong>Price:</strong> {{ number_format($product->price, 2) }} km</div>
    <div class="mb-3"><strong>Category:</strong> {{ $product->category->name ?? '-' }}</div>
    <div class="mb-3"><strong>Colors:</strong>
        @foreach($product->colors as $color)
        <span class="badge bg-secondary">{{ $color->name }}</span>
        @endforeach
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to list</a>
</div>
@endsection
