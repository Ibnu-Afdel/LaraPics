<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

class Search extends Component
{
    public $query = '';
    public $posts = [];
    public $tags = [];

    public function mount()
    {
        $this->tags = Tag::get();
    }

    public function updateQuery()
    {
        $this->posts = Post::where('caption', 'like', '%' . $this->query . '%')
            ->orWhereHas('tags', function ($q){
                $q->where('name', 'like', '%' . $this->query . '%');
            })->get();
    }


    public function render()
    {
        return view('livewire.search');
    }
}
