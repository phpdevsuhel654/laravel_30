@extends('layouts.app')

@section('content')
<h1>Edit Tag</h1>

<form action="{{ route('tags.update', $tag->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $tag->name) }}" required>
        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug:</label>
        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $tag->slug) }}" required>
        @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
