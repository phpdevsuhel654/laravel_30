@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Create Task</h1>

<div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ route('tasks.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Title</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2" placeholder="Task Title">
        </div>
        <div>
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" placeholder="Task Description"></textarea>
        </div>
        <div>
            <label class="block text-gray-700">Assign to User</label>
            <select name="user_id" class="w-full border rounded px-3 py-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
    </form>
</div>
@endsection
