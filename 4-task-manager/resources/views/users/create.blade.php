@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Create User</h1>

<div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" placeholder="Name">
        </div>
        <div>
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" placeholder="Email">
        </div>
        <div>
            <label class="block text-gray-700">Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" placeholder="Password">
        </div>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Save</button>
    </form>
</div>
@endsection
