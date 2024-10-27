<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
    public function index(Request $request)
    {
            $posts = Post::with('user')->orderBy('created_at' ,'desc')->get();

        $tags = Tag::get();
        return view('posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create' , ['tags'=>Tag::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'caption' => 'required',
            'image' => 'nullable|image|mimes:png,jpg|max:1024',
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
        $post->load('comments.user');
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post,  'tags'=>Tag::get()]);
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

    public function search(Request $request)
    {
        // changed to livewire, will be deleted in the next commits

//        $query = $request->input('query');
//        $posts = Post::where('caption', 'LIKE' , "%{$query}%")
//        ->orWhereHas('tags', function($q) use ($query) {
//            $q->where('name', 'LIKE', "%{$query}%");
//        }) -> get();
//
//        $tags = Tag::get();
//
//
//        return  view('posts.search', compact('posts', 'query', 'tags'));
    }

    public function postsByTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $posts = $tag->posts()->get();

        return view('posts.index', [
            'posts' => $posts,
            'tags' => Tag::all(),
        ]);
    }
}
