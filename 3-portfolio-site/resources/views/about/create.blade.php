@extends('layouts.app')

@section('content')
<h2>Add About</h2>
<form action="{{ route('about.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>
    <button class="btn btn-success">Save</button>
</form>
@endsection
