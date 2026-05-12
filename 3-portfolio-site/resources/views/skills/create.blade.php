@extends('layouts.app')

@section('content')
<h2>Add Skill</h2>
<form action="{{ route('skills.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Level</label>
        <input type="text" name="level" class="form-control">
    </div>
    <button class="btn btn-primary">Save</button>
</form>
@endsection
