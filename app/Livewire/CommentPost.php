<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentPost extends Component
{

    public $post;
    public $comments;
    public $commentText;
    public $editingCommentId = null;
    public $editingCommentText = '';


    public function mount($post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->post->comments()->latest()->get();
    }

    public function addComment()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'commentText' => 'required',
        ]);


        $comment = $this->post->comments()->create([
            'comment' => $this->commentText,
            'user_id' => Auth::id(),
        ]);
        $this->comments->prepend($comment);
        $this->reset('commentText');
    }

    public function editComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment && $comment->user_id === auth()->id()) {
            $this->editingCommentId = $commentId;
            $this->editingCommentText = $comment->comment;
        }
    }

    public function updateComment()
    {
        $this->validate([
            'editingCommentText' => 'required|max:255',
        ]);

        $comment = Comment::find($this->editingCommentId);
        if ($comment && $comment->user_id === auth()->id()) {
            $comment->update(['comment' => $this->editingCommentText]);
            $this->editingCommentId = null;
            $this->editingCommentText = '';
            $this->loadComments();
        }
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment && $comment->user_id === auth()->id()) {
            $comment->delete();
            $this->loadComments();
        }
    }

    public function cancelEdit()
    {
        $this->editingCommentId = null;
        $this->editingCommentText = '';
    }

    public function render()
    {
        return view('livewire.comment-post');
    }
}
