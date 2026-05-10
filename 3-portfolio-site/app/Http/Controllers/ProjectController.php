<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\MarkdownService;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        // Search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Sorting
        $sort = $request->input('sort', 'created_at'); // default sort
        $direction = $request->input('direction', 'desc'); // default direction
        $query->orderBy($sort, $direction);

        $projects = $query->paginate(5);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable',
            'link' => 'nullable|url'
        ]);

        Project::create($request->all());
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project, MarkdownService $markdown)
    {
        $project->description = $markdown->toHtml($project->description);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'nullable|url'
        ]);

        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
