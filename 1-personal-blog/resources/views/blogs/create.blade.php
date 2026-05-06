@extends('layouts.app')

@section('content')
<h1>Create Blog</h1>

<form action="{{ route('blogs.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" id="title" name="title" class="form-control" required value="{{ old('title') }}">
        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug:</label>
        <input type="text" id="slug" name="slug" class="form-control" required value="{{ old('slug') }}">
        @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content:</label>
        <textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>
        @error('content')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mb-3">
        <label for="categories" class="form-label">Categories:</label>
        <select id="categories" name="categories[]" class="form-control" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tags" class="form-label">Tags:</label>
        <select id="tags" name="tags[]" class="form-control" multiple>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
