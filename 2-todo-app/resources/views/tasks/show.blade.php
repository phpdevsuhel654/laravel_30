<!-- resources/views/tasks/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>{{ $task->title }}</h1>
<p>{{ $task->description }}</p>
<p><strong>Status:</strong> {{ $task->is_completed ? '✅ Completed' : '⏳ Pending' }}</p>
@endsection
