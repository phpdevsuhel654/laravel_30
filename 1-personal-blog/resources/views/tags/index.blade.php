@extends('layouts.app')

@section('content')
<h1 class="mb-3">Tags</h1>

<form method="GET" action="{{ route('tags.index') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search blogs..." value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="category" class="form-select">
            <option value="">Filter by Category</option>
            @foreach(App\Models\Category::all() as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="tag" class="form-select">
            <option value="">Filter by Tag</option>
            @foreach(App\Models\Tag::all() as $tag)
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

    <div class="col-md-12 mt-2">
        <button class="btn btn-primary">Apply</button>
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
{{ $tags->links() }}
@endsection
