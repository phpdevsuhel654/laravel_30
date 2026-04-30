<?php
// app/Http/Controllers/CategoryController.php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
	{
		$query = Category::query();

		if ($search = $request->input('search')) {
			$query->where('name', 'like', "%{$search}%");
		}

		$categories = $query->paginate(10); // paginate results
		return view('categories.index', compact('categories'));
	}

    public function store(Request $request)
    {
        return Category::create($request->only(['name', 'slug']));
    }

    public function show(Category $category)
    {
        return $category->load('blogs');
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->only(['name', 'slug']));
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
