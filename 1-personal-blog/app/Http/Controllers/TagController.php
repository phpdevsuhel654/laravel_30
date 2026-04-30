<?php
// app/Http/Controllers/TagController.php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
	{
		$query = Tag::query();

		if ($search = $request->input('search')) {
			$query->where('name', 'like', "%{$search}%");
		}

		$tags = $query->paginate(10); // paginate results
		return view('tags.index', compact('tags'));
	}

    public function store(Request $request)
    {
        return Tag::create($request->only(['name', 'slug']));
    }

    public function show(Tag $tag)
    {
        return $tag->load('blogs');
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->only(['name', 'slug']));
        return $tag;
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->noContent();
    }
}
