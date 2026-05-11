@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Task Details</h1>

<div class="bg-white shadow rounded-lg p-6 space-y-4">
    <p><strong>Title:</strong> {{ $task->title }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>User:</strong> {{ $task->user->name }}</p>
    <p><strong>Status:</strong> 
        <span class="px-2 py-1 rounded text-white 
            {{ $task->is_completed ? 'bg-green-500' : 'bg-orange-500' }}">
            {{ $task->is_completed ? 'Completed' : 'Pending' }}
        </span>
    </p>
    <div class="space-x-4">
        <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Back</a>
        <a href="{{ route('tasks.edit',$task) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
    </div>
</div>
@endsection
