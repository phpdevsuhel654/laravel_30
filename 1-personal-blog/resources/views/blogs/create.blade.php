<!-- resources/views/blogs/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Create Blog</h1>

<form action="{{ route('blogs.store') }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" required>

    <label>Content:</label>
    <textarea name="content" required></textarea>

    <label>Slug:</label>
    <input type="text" name="slug" required>

    <button type="submit">Save</button>
</form>
@endsection
