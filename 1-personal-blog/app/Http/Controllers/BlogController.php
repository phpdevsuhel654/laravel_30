<?php
// app/Http/Controllers/BlogController.php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::with(['categories', 'tags'])->get();
    }

    public function store(Request $request)
    {
        $blog = Blog::create($request->only(['title', 'content', 'slug']));
        $blog->categories()->sync($request->input('categories', []));
        $blog->tags()->sync($request->input('tags', []));
        return $blog;
    }

    public function show(Blog $blog)
    {
        return $blog->load(['categories', 'tags']);
    }

    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->only(['title', 'content', 'slug']));
        $blog->categories()->sync($request->input('categories', []));
        $blog->tags()->sync($request->input('tags', []));
        return $blog;
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->noContent();
    }
}
