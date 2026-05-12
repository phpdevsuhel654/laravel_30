@extends('layouts.app')

@section('content')
<h2>Projects</h2>

<form method="GET" action="{{ route('projects.index') }}" class="mb-3 d-flex">
    <input type="text" name="search" value="{{ request('search') }}" 
           class="form-control me-2" placeholder="Search projects...">

    <select name="sort" class="form-select me-2">
        <option value="created_at" {{ request('sort')=='created_at'?'selected':'' }}>Date</option>
        <option value="title" {{ request('sort')=='title'?'selected':'' }}>Title</option>
    </select>

    <select name="direction" class="form-select me-2">
        <option value="asc" {{ request('direction')=='asc'?'selected':'' }}>Ascending</option>
        <option value="desc" {{ request('direction')=='desc'?'selected':'' }}>Descending</option>
    </select>

    <button class="btn btn-primary">Apply</button>
</form>

<a href="{{ route('projects.create') }}" class="btn btn-success mb-3">Add Project</a>

<table class="table table-striped table-hover">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Link</th>
        <th>Actions</th>
    </tr>
    @foreach($projects as $project)
    <tr>
        <td>{{ $project->title }}</td>
        <td>{{ $project->description }}</td>
        <td><a href="{{ $project->link }}" target="_blank">{{ $project->link }}</a></td>
        <td>
            <a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $projects->links() }}
@endsection
