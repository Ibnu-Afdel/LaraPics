<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function(){
    Route::controller(PostController::class)->group(function(){
        Route::get('/posts/create' , 'create')->name('posts.create');
        Route::post('/posts' , 'store')->name('posts.store');
        Route::get('/posts/{post}/edit' , 'edit')->name('posts.edit')
        ->can('can-edit','post');
        Route::put('/posts/{post}' , 'update')->name('posts.update')
        ->can('can-edit','post');
        Route::delete('/posts/{post}' , 'destroy')->name('posts.destroy')
        ->can('can-edit','post');
        Route::get('/posts/tag/{tag}', 'postsByTag')->name('posts.byTag');
    });
    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/like', [LikeController::class, 'unlike'])->name('posts.unlike');

});

Route::middleware('guest')->group(function(){
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [SessionController::class, 'login'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');
});

Route::middleware('admin')->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin', 'index')->name('admin.index');
        Route::get('/admin/create', 'create')->name('admin.create');
        Route::post('/admin', 'store')->name('admin.store');
        Route::delete('/admin/{tag}', 'destroy')->name('admin.destroy');
    });
});

// Route::get('/post/comments', [PostController::class, 'show'])->name('comments');

Route::middleware('auth')->group(function(){
    Route::controller(CommentController::class)->group(function(){
        Route::post('posts/{post}/comment', 'store' )->name('comment.store');
        Route::get('comments/{comment}/edit', 'edit' )->name('comment.edit')
        ->can('can-comment','comment');;
        Route::put('comments/{comment}', 'update' )->name('comment.update')
        ->can('can-comment','comment');;
        Route::delete('comments/{comment}', 'destroy' )->name('comment.destroy')
        ->can('can-comment','comment');;
    });
});

Route::get('/' , [PostController::class , 'index' ])->name('posts.index');
Route::get('/posts' , [PostController::class , 'index' ])->name('posts.index');
Route::get('/posts/{post}', [PostController::class , 'show' ])->name('posts.show');
Route::get('/search', [PostController::class, 'search'])->name('posts.search');










