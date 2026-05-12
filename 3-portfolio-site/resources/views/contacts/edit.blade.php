@extends('layouts.app')

@section('content')
<h2>Edit Contact</h2>
<form action="{{ route('contacts.update', $contact) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $contact->name }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $contact->email }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Message</label>
        <textarea name="message" class="form-control" required>{{ $contact->message }}</textarea>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
