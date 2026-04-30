@extends('layouts.app')

@section('content')
<h1 class="mb-3">Categories</h1>

<form method="GET" action="{{ route('categories.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>

<a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Create New Category</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>
                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination links -->
{{ $categories->links() }}
@endsection
