<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

//posts
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('posts.show');

//tags
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');

//alpine
Route::get('/alpine', function () {
    return view('alpine');   // <- spell view name correctly
});