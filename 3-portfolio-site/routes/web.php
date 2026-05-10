<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('projects', ProjectController::class);
Route::resource('skills', SkillController::class);
Route::resource('about', AboutController::class);
Route::resource('contacts', ContactController::class);
