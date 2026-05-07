@extends('layouts.app')

@section('content')
<h1>Create Tag</h1>

<form action="{{ route('tags.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}" required>
        @error('slug')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('tags.index') }}" class="btn btn-secondary">Cancel</a>
</form>

<script>
document.getElementById('name').addEventListener('input', function() {
    var slug = slugify(this.value);
    document.getElementById('slug').value = slug;
});

function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
}
</script>
@endsection
