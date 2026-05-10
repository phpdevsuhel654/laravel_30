@extends('layouts.app')

@section('content')
<h2>Skills</h2>

<form method="GET" action="{{ route('skills.index') }}" class="mb-3 d-flex">
    <input type="text" name="search" value="{{ request('search') }}" 
           class="form-control me-2" placeholder="Search skills...">

    <select name="level" class="form-select me-2">
        <option value="">All Levels</option>
        <option value="Beginner" {{ request('level')=='Beginner'?'selected':'' }}>Beginner</option>
        <option value="Intermediate" {{ request('level')=='Intermediate'?'selected':'' }}>Intermediate</option>
        <option value="Expert" {{ request('level')=='Expert'?'selected':'' }}>Expert</option>
    </select>

    <select name="sort" class="form-select me-2">
        <option value="created_at" {{ request('sort')=='created_at'?'selected':'' }}>Date</option>
        <option value="name" {{ request('sort')=='name'?'selected':'' }}>Name</option>
    </select>

    <select name="direction" class="form-select me-2">
        <option value="asc" {{ request('direction')=='asc'?'selected':'' }}>Ascending</option>
        <option value="desc" {{ request('direction')=='desc'?'selected':'' }}>Descending</option>
    </select>

    <button class="btn btn-primary">Apply</button>
</form>

<a href="{{ route('skills.create') }}" class="btn btn-success mb-3">Add Skill</a>

<table class="table table-striped table-hover">
    <tr>
        <th>Name</th>
        <th>Level</th>
        <th>Actions</th>
    </tr>
    @foreach($skills as $skill)
    <tr>
        <td>{{ $skill->name }}</td>
        <td>{{ $skill->level }}</td>
        <td>
            <a href="{{ route('skills.show', $skill) }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ route('skills.edit', $skill) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('skills.destroy', $skill) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $skills->links() }}
@endsection
