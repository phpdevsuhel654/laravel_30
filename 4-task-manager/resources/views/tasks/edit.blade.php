@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Task</h1>

<div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ route('tasks.update',$task) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-gray-700">Title</label>
            <input type="text" name="title" value="{{ $task->title }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ $task->description }}</textarea>
        </div>
        <div>
            <label class="block text-gray-700">Assign to User</label>
            <select name="user_id" class="w-full border rounded px-3 py-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_completed" value="1" {{ $task->is_completed ? 'checked' : '' }} class="mr-2">
                Completed
            </label>
        </div>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
    </form>
</div>
@endsection
