<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('can-edit', function($user , Post $post){
            return $post->user_id === $user->id ;
        });

        Gate::define('can-comment', function($user , Comment $comment){
            return $comment->user_id ===  $user->id;
        });

      
    }
}
