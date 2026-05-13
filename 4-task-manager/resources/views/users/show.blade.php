@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">User Details</h1>

<div class="bg-white shadow rounded-lg p-6 space-y-4">
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <div class="space-x-4">
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Back</a>
        <a href="{{ route('users.edit',$user) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
    </div>
</div>
@endsection
