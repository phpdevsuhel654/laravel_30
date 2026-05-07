<?php

// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show all tasks
    public function index(Request $request)
	{
		$query = Task::query();

		// 🔍 Search filter
		if ($search = $request->input('search')) {
			$query->where('title', 'like', "%{$search}%")
				->orWhere('description', 'like', "%{$search}%");
		}

		// 🎯 Status filter
		if ($status = $request->input('status')) {
			if ($status === 'completed') {
				$query->completed();
			} elseif ($status === 'pending') {
				$query->pending();
			}
		}

		// 📊 Sorting
		$sort = $request->input('sort', 'latest');
		if ($sort === 'latest') {
			$query->orderBy('created_at', 'desc');
		} elseif ($sort === 'oldest') {
			$query->orderBy('created_at', 'asc');
		} elseif ($sort === 'title') {
			$query->orderBy('title', 'asc');
		}

		$tasks = $query->paginate(10);
		return view('tasks.index', compact('tasks'));
	}



    // Show form to create a new task
    public function create()
    {
        return view('tasks.create');
    }

    // Store new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create($request->only('title', 'description'));

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Show single task
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // Show form to edit task
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $task->update($request->only('title', 'description', 'is_completed'));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}

