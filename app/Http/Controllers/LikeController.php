<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // changed to livewire, will be deleted in the next commit

//    public function like(Post $post)
//    {
//        $post->likes()->create([
//            'user_id' => Auth::id(),
//        ]);
//
//        return back();
//    }
//
//    public function unlike(Post $post)
//    {
//        $post->likes()->where('user_id', Auth::id())->delete();
//
//        return back();
//    }

}
