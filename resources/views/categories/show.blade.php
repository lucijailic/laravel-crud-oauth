@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Category Details</h1>

    <div class="mb-3"><strong>Name:</strong> {{ $category->name }}</div>

    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to Categories</a>
</div>
@endsection
