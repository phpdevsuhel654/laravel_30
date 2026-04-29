<!-- resources/views/tags/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>{{ $tag->name }}</h1>
<p><strong>Slug:</strong> {{ $tag->slug }}</p>

<h3>Blogs with this Tag:</h3>
<ul>
    @foreach($tag->blogs as $blog)
        <li>{{ $blog->title }}</li>
    @endforeach
</ul>
@endsection
