<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;



Route::controller(PostController::class)->group(function(){
    Route::get('/posts' , 'index')->name('posts.index');
    Route::get('/posts/create' , 'create')->name('posts.create');
    Route::post('/posts' , 'store')->name('posts.store');
    Route::get('/posts/{post}' , 'show')->name('posts.show');
    Route::get('/posts/{post}/edit' , 'edit')->name('posts.edit');
    Route::put('/posts/{post}' , 'update')->name('posts.update');
    Route::delete('/posts/{post}' , 'destroy')->name('posts.destroy');
});

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [SessionController::class, 'login'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');


