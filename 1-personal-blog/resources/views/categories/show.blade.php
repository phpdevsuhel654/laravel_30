@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $category->name }}</h1>
    <p><strong>Slug:</strong> {{ $category->slug }}</p>

    <h3 class="mt-4">Blogs in this Category:</h3>
    @if($category->blogs->isEmpty())
        <p class="text-muted">No blogs found in this category.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->user->name ?? 'Unknown' }}</td>
                    <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="mt-4">
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
