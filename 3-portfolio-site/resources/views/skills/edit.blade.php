@extends('layouts.app')

@section('content')
<h2>Edit Skill</h2>
<form action="{{ route('skills.update', $skill) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ $skill->name }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Level</label>
        <input type="text" name="level" value="{{ $skill->level }}" class="form-control">
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
