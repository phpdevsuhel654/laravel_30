<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Services\MarkdownService;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['categories', 'tags', 'user']);

        // Search filter
        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        }

        // Category filter
        if ($categoryId = $request->input('category')) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        // Tag filter
        if ($tagId = $request->input('tag')) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tags.id', $tagId);
            });
        }

        // Sorting
        $sort = $request->input('sort', 'latest');
        if ($sort === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'title') {
            $query->orderBy('title', 'asc');
        }

        $blogs = $query->paginate(10);
        $categories = Category::all();
        $tags = Tag::all();

        return view('blogs.index', compact('blogs', 'categories', 'tags'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('blogs.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'required|string|unique:blogs',
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
        ]);

        $blog = Blog::create(array_merge($validated, ['user_id' => auth()->id() ?? 1]));
        $blog->categories()->sync($request->input('categories', []));
        $blog->tags()->sync($request->input('tags', []));

        return redirect()->route('blogs.show', $blog->id)->with('success', 'Blog created successfully');
    }

    public function show(Blog $blog, MarkdownService $markdown)
    {
        $blog->load(['categories', 'tags', 'user']);
        $blog->content = $markdown->toHtml($blog->content);
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('blogs.edit', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'required|string|unique:blogs,slug,' . $blog->id,
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
        ]);

        $blog->update($validated);
        $blog->categories()->sync($request->input('categories', []));
        $blog->tags()->sync($request->input('tags', []));

        return redirect()->route('blogs.show', $blog->id)->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
}
