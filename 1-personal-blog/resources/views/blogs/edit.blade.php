<!-- resources/views/blogs/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Blog</h1>

<form action="{{ route('blogs.update', $blog->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Title:</label>
    <input type="text" name="title" value="{{ $blog->title }}" required>

    <label>Content:</label>
    <textarea name="content" required>{{ $blog->content }}</textarea>

    <label>Slug:</label>
    <input type="text" name="slug" value="{{ $blog->slug }}" required>

    <button type="submit">Update</button>
</form>
@endsection
