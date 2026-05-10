@extends('layouts.app')

@section('content')
<h2>Edit Project</h2>
<form action="{{ route('projects.update', $project) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" value="{{ $project->title }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ $project->description }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Link</label>
        <input type="url" name="link" value="{{ $project->link }}" class="form-control">
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
