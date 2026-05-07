@extends('layouts.app')

@section('content')
<h1 class="mb-3">Tags</h1>

<form method="GET" action="{{ route('tags.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search tags..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>

<a href="{{ route('tags.create') }}" class="btn btn-success mb-3">Create New Tag</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tags as $tag)
        <tr>
            <td>{{ $tag->name }}</td>
            <td>{{ $tag->slug }}</td>
            <td>
                <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination links -->
<div class="d-flex justify-content-center mt-4">
    {{ $tags->links('pagination::bootstrap-5') }}
</div>
@endsection
