<!-- resources/views/tags/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Tag</h1>

<form action="{{ route('tags.update', $tag->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $tag->name }}" required>

    <label>Slug:</label>
    <input type="text" name="slug" value="{{ $tag->slug }}" required>

    <button type="submit">Update</button>
</form>
@endsection
