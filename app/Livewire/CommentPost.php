<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentPost extends Component
{
    public $post;
    public $commentText;
    public $comments;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->comments = $post->comments()->latest()->get();
    }

    public function addComment()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if the user is not authenticated
        }

        $this->validate([
            'commentText' => 'required',
        ]);

        $comment = $this->post->comments()->create([
            'comment' => $this->commentText,
            'user_id' => Auth::id(),
        ]);

        $this->comments->prepend($comment);  // Add the new comment to the beginning
        $this->commentText = '';  // Clear the input field
    }


    public function render()
    {
        return view('livewire.comment-post');
    }
}
