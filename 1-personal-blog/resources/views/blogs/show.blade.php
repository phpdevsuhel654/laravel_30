<!-- resources/views/blogs/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>{{ $blog->title }}</h1>
<p>{{ $blog->content }}</p>
<p><strong>Slug:</strong> {{ $blog->slug }}</p>

<h3>Categories:</h3>
<ul>
    @foreach($blog->categories as $category)
        <li>{{ $category->name }}</li>
    @endforeach
</ul>

<h3>Tags:</h3>
<ul>
    @foreach($blog->tags as $tag)
        <li>{{ $tag->name }}</li>
    @endforeach
</ul>
@endsection
