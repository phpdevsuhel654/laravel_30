@extends('layouts.app')

@section('content')
<h2>Contact Details</h2>
<p><strong>Name:</strong> {{ $contact->name }}</p>
<p><strong>Email:</strong> {{ $contact->email }}</p>
<p><strong>Message:</strong> {{ $contact->message }}</p>

<a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back</a>
@endsection
