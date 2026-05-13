<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use App\Models\Task;

// Default welcome or redirect
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// API Documentation
Route::get('/api/docs', function () {
    return view('api-docs');
})->name('api.docs');

// API Tester (HTML interface)
Route::get('/api-tester', function () {
    return file_get_contents(public_path('api-tester.html'));
})->name('api.tester');

// Dashboard
Route::get('/dashboard', function () {
    $userCount = User::count();
    $taskCount = Task::count();
    $completedTasks = Task::where('is_completed', true)->count();
    $pendingTasks = Task::where('is_completed', false)->count();

    return view('dashboard', compact('userCount','taskCount','completedTasks','pendingTasks'));
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('tasks', TaskController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
