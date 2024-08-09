<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', ['tags'=> Tag::all()]);
    }

    public function create()
    {
        return view('admin.create');
    }
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'name' => 'required',
        ]);

        Tag::create($attribute);
        return redirect()->route('admin.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back();
    }

}
