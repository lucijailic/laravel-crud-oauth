@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Color Details</h1>

    <div class="mb-3"><strong>Name:</strong> {{ $color->name }}</div>

    <a href="{{ route('colors.index') }}" class="btn btn-secondary">Back to list</a>
</div>
@endsection
