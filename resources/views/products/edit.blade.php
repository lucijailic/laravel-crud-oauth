@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Product: {{ $product->name }}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price (km)</label>
            <input type="number" step="0.01" min="0" name="price" class="form-control" id="price" value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="colors" class="form-label">Colors</label>
            <select name="colors[]" id="colors" class="form-select" multiple>
                @foreach($colors as $color)
                <option value="{{ $color->id }}"
                        {{ in_array($color->id, old('colors', $product->colors->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $color->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save changes</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
