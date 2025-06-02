@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create Color</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('colors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Color Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Color</button>
        <a href="{{ route('colors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
