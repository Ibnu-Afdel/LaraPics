<?php

use App\Http\Controllers\AdminController;
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
    });
    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
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

Route::get('/' , [PostController::class , 'index' ])->name('posts.index');
Route::get('/posts' , [PostController::class , 'index' ])->name('posts.index');
Route::get('/posts/{post}', [PostController::class , 'show' ])->name('posts.show');









