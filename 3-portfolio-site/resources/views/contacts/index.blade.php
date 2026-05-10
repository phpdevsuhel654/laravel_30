@extends('layouts.app')

@section('content')
<h2>Contacts</h2>

<form method="GET" action="{{ route('contacts.index') }}" class="mb-3 d-flex">
    <input type="text" name="search" value="{{ request('search') }}" 
           class="form-control me-2" placeholder="Search contacts...">

    <select name="domain" class="form-select me-2">
        <option value="">All Domains</option>
        <option value="gmail.com" {{ request('domain')=='gmail.com'?'selected':'' }}>Gmail</option>
        <option value="yahoo.com" {{ request('domain')=='yahoo.com'?'selected':'' }}>Yahoo</option>
        <option value="outlook.com" {{ request('domain')=='outlook.com'?'selected':'' }}>Outlook</option>
    </select>

    <select name="sort" class="form-select me-2">
        <option value="created_at" {{ request('sort')=='created_at'?'selected':'' }}>Date</option>
        <option value="name" {{ request('sort')=='name'?'selected':'' }}>Name</option>
        <option value="email" {{ request('sort')=='email'?'selected':'' }}>Email</option>
    </select>

    <select name="direction" class="form-select me-2">
        <option value="asc" {{ request('direction')=='asc'?'selected':'' }}>Ascending</option>
        <option value="desc" {{ request('direction')=='desc'?'selected':'' }}>Descending</option>
    </select>

    <button class="btn btn-primary">Apply</button>
</form>

<a href="{{ route('contacts.create') }}" class="btn btn-success mb-3">Add Contact</a>

<table class="table table-striped table-hover">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Actions</th>
    </tr>
    @foreach($contacts as $contact)
    <tr>
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ Str::limit($contact->message, 50) }}</td>
        <td>
            <a href="{{ route('contacts.show', $contact) }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $contacts->links() }}
@endsection
