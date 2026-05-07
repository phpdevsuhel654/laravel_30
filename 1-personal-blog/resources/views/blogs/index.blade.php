@extends('layouts.app')

@section('content')
<h1 class="mb-3">Blogs</h1>

<form method="GET" action="{{ route('blogs.index') }}" class="row g-3 mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search blogs..." value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="category" class="form-select">
            <option value="">Filter by Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="tag" class="form-select">
            <option value="">Filter by Tag</option>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select name="sort" class="form-select">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
        </select>
    </div>

    <div class="col-md-12">
        <button class="btn btn-primary">Apply</button>
    </div>
</form>

<a href="{{ route('blogs.create') }}" class="btn btn-success mb-3">Create New Blog</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($blogs as $blog)
        <tr>
            <td>{{ $blog->title }}</td>
            <td>{{ $blog->slug }}</td>
            <td>
                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
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
    {{ $blogs->links('pagination::bootstrap-5') }}
</div>
@endsection
