<!-- resources/views/categories/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Category</h1>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $category->name }}" required>

    <label>Slug:</label>
    <input type="text" name="slug" value="{{ $category->slug }}" required>

    <button type="submit">Update</button>
</form>
@endsection
