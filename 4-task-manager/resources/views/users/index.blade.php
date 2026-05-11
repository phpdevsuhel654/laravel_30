@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Users</h1>

<a href="{{ route('users.create') }}" 
   class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 mb-4 inline-block">
   + Create User
</a>

<div class="bg-white shadow rounded-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($users as $user)
            <tr>
                <td class="px-6 py-4">{{ $user->name }}</td>
                <td class="px-6 py-4">{{ $user->email }}</td>
                <td class="px-6 py-4 space-x-2">
                    <a href="{{ route('users.show',$user) }}" class="text-blue-600 hover:underline">View</a>
                    <a href="{{ route('users.edit',$user) }}" class="text-indigo-600 hover:underline">Edit</a>
                    <form action="{{ route('users.destroy',$user) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection
