<!DOCTYPE html>
<html>
<head>
    <title>Personal Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Personal Blog</a>
            <div>
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-light me-2">Blogs</a>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-light me-2">Categories</a>
                <a href="{{ route('tags.index') }}" class="btn btn-outline-light">Tags</a>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
