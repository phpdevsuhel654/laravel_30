<!DOCTYPE html>
<html>
<head>
    <title>Portfolio Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('projects.index') }}">Portfolio</a>
        <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a href="{{ route('projects.index') }}" class="nav-link">Projects</a></li>
            <li class="nav-item"><a href="{{ route('skills.index') }}" class="nav-link">Skills</a></li>
            <li class="nav-item"><a href="{{ route('about.index') }}" class="nav-link">About</a></li>
            <li class="nav-item"><a href="{{ route('contacts.index') }}" class="nav-link">Contacts</a></li>
        </ul>
        </div>
    </div>
    </nav>


    @yield('content')
</div>
</body>
</html>
