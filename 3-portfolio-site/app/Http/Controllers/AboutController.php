<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use App\Services\MarkdownService;

class AboutController extends Controller
{
    public function index(MarkdownService $markdown)
    {
        $about = About::first();
        if ($about) {
            $about->content = $markdown->toHtml($about->content);
        }
        return view('about.index', compact('about'));
    }

    public function create()
    {
        return view('about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        About::create($request->all());
        return redirect()->route('about.index')->with('success', 'About section created successfully.');
    }

    public function edit(About $about)
    {
        return view('about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $about->update($request->all());
        return redirect()->route('about.index')->with('success', 'About section updated successfully.');
    }

    public function destroy(About $about)
    {
        $about->delete();
        return redirect()->route('about.index')->with('success', 'About section deleted successfully.');
    }
}
