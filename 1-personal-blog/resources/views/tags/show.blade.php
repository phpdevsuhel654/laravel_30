@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $tag->name }}</h1>
    <p><strong>Slug:</strong> {{ $tag->slug }}</p>

    <h3 class="mt-4">Blogs with this Tag:</h3>
    @if($tag->blogs->isEmpty())
        <p class="text-muted">No blogs found with this tag.</p>
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
                @foreach($tag->blogs as $blog)
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
        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
