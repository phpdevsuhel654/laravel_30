<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ContactController;

Route::apiResource('projects', ProjectController::class);
Route::apiResource('skills', SkillController::class);
Route::apiResource('about', AboutController::class);
Route::apiResource('contacts', ContactController::class);
