<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return response()->json(About::first());
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $about = About::create($request->all());
        return response()->json($about, 201);
    }

    public function show(About $about)
    {
        return response()->json($about);
    }

    public function update(Request $request, About $about)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $about->update($request->all());
        return response()->json($about);
    }

    public function destroy(About $about)
    {
        $about->delete();
        return response()->json(null, 204);
    }
}
