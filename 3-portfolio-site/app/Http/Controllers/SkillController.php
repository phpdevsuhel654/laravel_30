<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $query = Skill::query();

        // Search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('level', 'like', "%{$search}%");
        }

        // Filtering by level
        if ($request->filled('level')) {
            $query->where('level', $request->input('level'));
        }

        // Sorting
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');
        $query->orderBy($sort, $direction);

        $skills = $query->paginate(5);
        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        return view('skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'nullable'
        ]);

        Skill::create($request->all());
        return redirect()->route('skills.index')->with('success', 'Skill added successfully.');
    }

    public function show(Skill $skill)
    {
        return view('skills.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        return view('skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $skill->update($request->all());
        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
    }
}
