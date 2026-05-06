@extends('layouts.app')

@section('content')
<h1>Edit Category</h1>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug:</label>
        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
        @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
