@extends('layouts.app')

@section('content')
<h1>Edit Blog</h1>

<form action="{{ route('blogs.update', $blog->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content:</label>
        <textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content', $blog->content) }}</textarea>
        @error('content')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug:</label>
        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $blog->slug) }}" required>
        @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="mb-3">
        <label for="categories" class="form-label">Categories:</label>
        <select id="categories" name="categories[]" class="form-control" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $blog->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple</small>
    </div>

    <div class="mb-3">
        <label for="tags" class="form-label">Tags:</label>
        <select id="tags" name="tags[]" class="form-control" multiple>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ $blog->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
            @endforeach
        </select>
        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple</small>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
