@extends('layouts.app')

@section('content')
<h2>Add Project</h2>
<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Link</label>
        <input type="url" name="link" class="form-control">
    </div>
    <button class="btn btn-primary">Save</button>
</form>
@endsection
