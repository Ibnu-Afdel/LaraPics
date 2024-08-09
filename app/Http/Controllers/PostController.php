<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', ['posts' => Post::all(), 'tags'=>Tag::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create' , ['tags'=>Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'caption' => 'required',
            'image' => 'nullable|image|mimes:png,jpg',
        ]);

        $request->validate([
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')){
            $filepath = $request->file('image')->store('images', 'public');
            $attributes['image'] = Storage::url($filepath) ;
        }else{
            $attributes['image'] = null ;
        }

        $attributes['user_id'] = Auth::user()->id;

        $post = Post::create($attributes);

        if ($request->filled('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post,  'tags'=>Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $attributes = $request->validate([
            'caption' => 'required',
            'image' => 'nullable|image|mimes:png,jpg'
        ]);

        
        $request->validate([
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')){
            if($post->image){
                Storage::disk('public')->delete(str_replace('/storage/', '' , $post->image));
            }
            $filepath = $request->file('image')->store('images', 'public');
            $attributes['image'] = Storage::url($filepath);
        }
        

        $post->update($attributes);

        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::disk('public')->delete(str_replace('storage', '' , 'images'));
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
