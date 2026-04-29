<!-- resources/views/categories/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Create Category</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Slug:</label>
    <input type="text" name="slug" required>

    <button type="submit">Save</button>
</form>
@endsection
