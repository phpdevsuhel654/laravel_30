@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit User</h1>

<div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ route('users.update',$user) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-gray-700">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
    </form>
</div>
@endsection
