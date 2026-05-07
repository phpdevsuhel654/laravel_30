<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| These routes handle the web interface for the To-Do List application.
| They provide CRUD operations via Blade views.
|
*/

// Redirect root URL to tasks index
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Resource routes for tasks (CRUD)
Route::resource('tasks', TaskController::class);
