<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Task Manager') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <div class="text-xl font-bold text-indigo-600">
                    Task Manager
                </div>
                <div class="space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600">Dashboard</a>
                    <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-indigo-600">Users</a>
                    <a href="{{ route('tasks.index') }}" class="text-gray-700 hover:text-indigo-600">Tasks</a>
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>

		<!-- Flash Messages -->
		@if (session('success'))
			<div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
				{{ session('success') }}
				<button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
					✖
				</button>
			</div>
		@endif

		@if (session('error'))
			<div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
				{{ session('error') }}
			</div>
		@endif


        <!-- Main Content -->
        <main class="flex-grow max-w-7xl mx-auto px-4 py-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow mt-6">
            <div class="max-w-7xl mx-auto px-4 py-4 text-center text-gray-500">
                © {{ date('Y') }} Task Manager. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
