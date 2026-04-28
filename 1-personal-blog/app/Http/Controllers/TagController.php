<?php
// app/Http/Controllers/TagController.php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return Tag::with('blogs')->get();
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
