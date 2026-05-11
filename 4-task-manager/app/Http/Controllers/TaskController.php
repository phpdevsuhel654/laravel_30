<?php

// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
	{
		$query = Task::with('user');

		// 🔍 Search filter
		if ($search = $request->input('search')) {
			$query->where(function($q) use ($search) {
				$q->where('title', 'like', "%{$search}%")
				->orWhere('description', 'like', "%{$search}%");
			});
		}

		// 🎯 Status filter
		if ($status = $request->input('status')) {
			if ($status === 'completed') {
				$query->where('is_completed', true);
			} elseif ($status === 'pending') {
				$query->where('is_completed', false);
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

    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'user_id'=>'required|exists:users,id'
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success','Task created successfully');
    }

    public function edit(Task $task)
    {
        $users = User::all();
        return view('tasks.edit', compact('task','users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'=>'required',
            'user_id'=>'required|exists:users,id'
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success','Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Task deleted successfully');
    }

	public function show(Task $task)
    {
        $users = User::all();
        return view('tasks.show', compact('task','users'));
    }
}
