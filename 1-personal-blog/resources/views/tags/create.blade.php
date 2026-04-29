<!-- resources/views/tags/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Create Tag</h1>

<form action="{{ route('tags.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Slug:</label>
    <input type="text" name="slug" required>

    <button type="submit">Save</button>
</form>
@endsection
