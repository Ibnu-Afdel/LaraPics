<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLiked;
    public $likesCount;

    public function mount(Post $post)
    {
        $this -> post = $post;
        $this->isLiked = $post->isLikedBy(auth()->user());
        $this->likesCount = $post->likes->count();
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if the user is not authenticated
        }
        if ($this->isLiked) {
            $this->post->likes()->where('user_id', Auth::id())->delete();
            $this->likesCount--;
        } else {
            $this->post->likes()->create(['user_id' => Auth::id()]);
            $this->likesCount++;
        }

        $this->isLiked = !$this->isLiked;
    }
    public function render()
    {
        return view('livewire.like-post');
    }
}
