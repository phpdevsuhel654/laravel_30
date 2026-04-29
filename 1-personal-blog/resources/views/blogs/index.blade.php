<!-- resources/views/blogs/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Blogs</h1>
<a href="{{ route('blogs.create') }}">Create New Blog</a>

<ul>
    @foreach($blogs as $blog)
        <li>
            <a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
            <a href="{{ route('blogs.edit', $blog->id) }}">Edit</a>
            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
@endsection
