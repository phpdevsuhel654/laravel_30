<?php
// app/Http/Controllers/BlogController.php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Services\MarkdownService;

class BlogController extends Controller
{
    public function index(Request $request)
	{
		$query = Blog::with(['categories', 'tags']);

		// Search filter
		if ($search = $request->input('search')) {
			$query->where('title', 'like', "%{$search}%")
				->orWhere('content', 'like', "%{$search}%");
		}

		// Category filter
		if ($categoryId = $request->input('category')) {
			$query->whereHas('categories', function ($q) use ($categoryId) {
				$q->where('id', $categoryId);
			});
		}

		// Tag filter
		if ($tagId = $request->input('tag')) {
			$query->whereHas('tags', function ($q) use ($tagId) {
				$q->where('id', $tagId);
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
		return view('blogs.index', compact('blogs'));
	}


    public function store(Request $request)
    {
        $blog = Blog::create($request->only(['title', 'content', 'slug']));
        $blog->categories()->sync($request->input('categories', []));
        $blog->tags()->sync($request->input('tags', []));
        return $blog;
    }

    public function show(Blog $blog, MarkdownService $markdown)
    {
		$blog->content = $markdown->toHtml($blog->content);
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
