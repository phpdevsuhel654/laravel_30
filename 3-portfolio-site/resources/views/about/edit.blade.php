@extends('layouts.app')

@section('content')
<h2>Edit About</h2>
<form action="{{ route('about.update', $about) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="5" required>{{ $about->content }}</textarea>
    </div>
    <button class="btn btn-warning">Update</button>
</form>
@endsection
