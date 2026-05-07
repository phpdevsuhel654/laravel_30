<!-- resources/views/tasks/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Task</h1>

<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" value="{{ $task->title }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ $task->description }}</textarea>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="is_completed" value="1" class="form-check-input" {{ $task->is_completed ? 'checked' : '' }}>
        <label class="form-check-label">Completed</label>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
