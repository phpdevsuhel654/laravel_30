@extends('layouts.app')

@section('content')
<h1>{{ $blog->title }}</h1>

<div class="mt-3">
    {!! $blog->content !!}
</div>

<h3 class="mt-4">Categories:</h3>
<ul>
    @foreach($blog->categories as $category)
        <li>{{ $category->name }}</li>
    @endforeach
</ul>

<h3 class="mt-4">Tags:</h3>
<ul>
    @foreach($blog->tags as $tag)
        <li>{{ $tag->name }}</li>
    @endforeach
</ul>
@endsection
