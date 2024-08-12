<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
       
        $attributes = $request->validate([
            'comment' => 'required',
            'post_id' => 'required|integer|exists:posts,id'
        ]);
        $attributes['user_id'] = Auth::id();

        Comment::create($attributes);
        
        return redirect()->route('posts.show', $request->post_id);
    }

    /**
     * Display the specified resource.
     */


    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment, Post $post)
    {
        $attributes = $request->validate([
            'comment' => 'required',
        ]);
     

        $comment->update($attributes);
        
        return redirect()->route('posts.show', $comment->post_id);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
