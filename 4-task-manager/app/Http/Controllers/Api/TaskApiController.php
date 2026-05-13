<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Tasks",
 *     description="API endpoints for managing tasks"
 * )
 */
class TaskApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     operationId="getTasksList",
     *     tags={"Tasks"},
     *     summary="Get list of tasks",
     *     description="Returns paginated list of tasks with filtering and sorting options",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by title or description",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter by status: completed or pending",
     *         required=false,
     *         @OA\Schema(type="string", enum={"completed", "pending"})
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Sort by: latest, oldest, or title",
     *         required=false,
     *         @OA\Schema(type="string", enum={"latest", "oldest", "title"})
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Task")),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $query = Task::with('user');

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            if ($status === 'completed') {
                $query->where('is_completed', true);
            } elseif ($status === 'pending') {
                $query->where('is_completed', false);
            }
        }

        $sort = $request->input('sort', 'latest');
        if ($sort === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'title') {
            $query->orderBy('title', 'asc');
        }

        $tasks = $query->paginate(10);

        return response()->json($tasks);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     operationId="getTaskById",
     *     tags={"Tasks"},
     *     summary="Get task by ID",
     *     description="Returns a single task with user information",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function show(Task $task): JsonResponse
    {
        return response()->json($task->load('user'));
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     operationId="createTask",
     *     tags={"Tasks"},
     *     summary="Create a new task",
     *     description="Creates a new task and assigns it to a user",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Task data",
     *         @OA\JsonContent(
     *             required={"title", "user_id"},
     *             @OA\Property(property="title", type="string", example="Complete project report"),
     *             @OA\Property(property="description", type="string", example="Finish the Q2 project report", nullable=true),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="is_completed", type="boolean", example=false)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'is_completed' => 'boolean'
        ]);

        $task = Task::create($validated);

        return response()->json($task->load('user'), 201);
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     operationId="updateTask",
     *     tags={"Tasks"},
     *     summary="Update a task",
     *     description="Updates an existing task",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Task data to update",
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="is_completed", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function update(Request $request, Task $task): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'exists:users,id',
            'is_completed' => 'boolean'
        ]);

        $task->update($validated);

        return response()->json($task->load('user'));
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     operationId="deleteTask",
     *     tags={"Tasks"},
     *     summary="Delete a task",
     *     description="Deletes a task permanently",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Task deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Post(
     *     path="/api/tasks/{id}/toggle-completion",
     *     operationId="toggleTaskCompletion",
     *     tags={"Tasks"},
     *     summary="Toggle task completion status",
     *     description="Toggles the completion status of a task",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task completion status toggled successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function toggleCompletion(Task $task): JsonResponse
    {
        $task->update(['is_completed' => !$task->is_completed]);

        return response()->json($task->load('user'));
    }
}
