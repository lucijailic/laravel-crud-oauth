@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Colors</h1>

    <a href="{{ route('colors.create') }}" class="btn btn-success mb-3">Add Color</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($colors as $color)
        <tr>
            <td>{{ $color->name }}</td>
            <td>
                <a href="{{ route('colors.show', $color) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('colors.edit', $color) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('colors.destroy', $color) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="2" class="text-center">No colors found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $colors->links() }}
</div>
@endsection
