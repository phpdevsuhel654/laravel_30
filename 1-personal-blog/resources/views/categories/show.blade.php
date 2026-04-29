<!-- resources/views/categories/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>{{ $category->name }}</h1>
<p><strong>Slug:</strong> {{ $category->slug }}</p>

<h3>Blogs in this Category:</h3>
<ul>
    @foreach($category->blogs as $blog)
        <li>{{ $blog->title }}</li>
    @endforeach
</ul>
@endsection
