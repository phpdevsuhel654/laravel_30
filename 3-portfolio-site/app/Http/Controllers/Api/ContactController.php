<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return response()->json(Contact::paginate(5));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required'
        ]);

        $contact = Contact::create($request->all());
        return response()->json($contact, 201);
    }

    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required'
        ]);

        $contact->update($request->all());
        return response()->json($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(null, 204);
    }
}
