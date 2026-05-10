@extends('layouts.app')

@section('content')
<h2>About</h2>
@if($about)
    <div class="card mb-3">
        <div class="card-body">
            {!! $about->content !!}
        </div>
    </div>
    <a href="{{ route('about.edit', $about) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('about.destroy', $about) }}" method="POST" style="display:inline;">
        @csrf @method('DELETE')
        <button class="btn btn-danger">Delete</button>
    </form>
@else
    <a href="{{ route('about.create') }}" class="btn btn-success">Add About</a>
@endif
@endsection
