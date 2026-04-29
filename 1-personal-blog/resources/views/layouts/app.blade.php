<!DOCTYPE html>
<html>
<head>
    <title>Personal Blog</title>
</head>
<body>
    <nav>
        <a href="{{ route('blogs.index') }}">Blogs</a>
        <a href="{{ route('categories.index') }}">Categories</a>
        <a href="{{ route('tags.index') }}">Tags</a>
    </nav>
    <hr>
    @yield('content')
</body>
</html>
