@extends('layouts.app')

@section('content')
<h1>Tasks</h1>

<form method="GET" action="{{ route('tasks.index') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search tasks..." value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Filter by Status</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="sort" class="form-select">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary">Apply</button>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a></td>
            <td>{{ $task->is_completed ? '✅ Completed' : '⏳ Pending' }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
	{{ $tasks->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection
