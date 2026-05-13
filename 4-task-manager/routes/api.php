<?php

/**
 * @OA\Info(
 *     title="Task Manager API",
 *     version="1.0.0",
 *     description="API for managing tasks and users",
 *     @OA\Contact(name="Support")
 * )
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Development server"
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based based authentication",
 *     in="header",
 *     scheme="bearer",
 *     securityScheme="bearerAuth",
 * )
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskApiController;

Route::apiResource('tasks', TaskApiController::class);
Route::post('tasks/{task}/toggle-completion', [TaskApiController::class, 'toggleCompletion']);
