@extends('layouts.app')

@section('content')
<h2>Add Contact</h2>
<form action="{{ route('contacts.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Message</label>
        <textarea name="message" class="form-control" required></textarea>
    </div>
    <button class="btn btn-primary">Save</button>
</form>
@endsection
