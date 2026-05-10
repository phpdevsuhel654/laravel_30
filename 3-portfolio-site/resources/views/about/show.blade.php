@extends('layouts.app')

@section('content')
<h2>About</h2>
@if($about)
    <p>{{ $about->content }}</p>
    <a href="{{ route('about.edit', $about) }}" class="btn btn-warning">Edit</a>
@else
    <a href="{{ route('about.create') }}" class="btn btn-success">Add About</a>
@endif
@endsection
