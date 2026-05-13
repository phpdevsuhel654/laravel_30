@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <h3 class="text-lg font-semibold text-gray-600">Total Users</h3>
        <p class="text-3xl font-bold text-indigo-600">{{ $userCount }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <h3 class="text-lg font-semibold text-gray-600">Total Tasks</h3>
        <p class="text-3xl font-bold text-indigo-600">{{ $taskCount }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <h3 class="text-lg font-semibold text-gray-600">Completed Tasks</h3>
        <p class="text-3xl font-bold text-green-600">{{ $completedTasks }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <h3 class="text-lg font-semibold text-gray-600">Pending Tasks</h3>
        <p class="text-3xl font-bold text-orange-600">{{ $pendingTasks }}</p>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Task Overview</h2>
        <canvas id="taskChart"></canvas>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Users vs Tasks</h2>
        <canvas id="userTaskChart"></canvas>
    </div>
</div>

<!-- Quick Links -->
<div class="mt-8 bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Quick Links</h2>
    <div class="space-x-4">
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Manage Users</a>
        <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Manage Tasks</a>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Task Completion Chart
    new Chart(document.getElementById('taskChart'), {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending'],
            datasets: [{
                data: [{{ $completedTasks }}, {{ $pendingTasks }}],
                backgroundColor: ['#4CAF50', '#FF9800']
            }]
        }
    });

    // User vs Task Chart
    new Chart(document.getElementById('userTaskChart'), {
        type: 'bar',
        data: {
            labels: ['Users', 'Tasks'],
            datasets: [{
                label: 'Count',
                data: [{{ $userCount }}, {{ $taskCount }}],
                backgroundColor: ['#2196F3', '#9C27B0']
            }]
        }
    });
</script>
@endpush
