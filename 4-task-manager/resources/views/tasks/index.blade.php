@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tasks</h1>

<!-- Search, Filter & Sort Form -->
<form method="GET" action="{{ route('tasks.index') }}" class="mb-6 flex space-x-4">
    <input type="text" name="search" value="{{ request('search') }}"
           class="w-1/3 border rounded px-3 py-2" placeholder="Search tasks...">

    <select name="status" class="border rounded px-3 py-2">
        <option value="">All Status</option>
        <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>Completed</option>
        <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
    </select>

    <select name="sort" class="border rounded px-3 py-2">
        <option value="latest" {{ request('sort')=='latest' ? 'selected' : '' }}>Latest</option>
        <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>Oldest</option>
        <option value="title" {{ request('sort')=='title' ? 'selected' : '' }}>Title</option>
    </select>

    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
        Apply
    </button>
</form>

<a href="{{ route('tasks.create') }}" 
   class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 mb-4 inline-block">
   + Create Task
</a>

<div class="bg-white shadow rounded-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($tasks as $task)
            <tr>
                <td class="px-6 py-4">{{ $task->title }}</td>
                <td class="px-6 py-4">{{ $task->user->name }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-white 
                        {{ $task->is_completed ? 'bg-green-500' : 'bg-orange-500' }}">
                        {{ $task->is_completed ? 'Completed' : 'Pending' }}
                    </span>
                </td>
                <td class="px-6 py-4 space-x-2">
                    <a href="{{ route('tasks.show',$task) }}" class="text-blue-600 hover:underline">View</a>
                    <a href="{{ route('tasks.edit',$task) }}" class="text-indigo-600 hover:underline">Edit</a>
                    <form action="{{ route('tasks.destroy',$task) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $tasks->links() }}</div>
</div>
@endsection
