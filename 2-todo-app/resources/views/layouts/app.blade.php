<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
	<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <nav class="mb-3">
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Tasks</a>
        <a href="{{ route('tasks.create') }}" class="btn btn-success">Add Task</a>
    </nav>
	@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif

	@if (session('error'))
		<div class="alert alert-danger">
			{{ session('error') }}
		</div>
	@endif

    @yield('content')
</body>
</html>
