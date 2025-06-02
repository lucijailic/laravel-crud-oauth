@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Color: {{ $color->name }}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('colors.update', $color) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Color Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $color->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save changes</button>
        <a href="{{ route('colors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
