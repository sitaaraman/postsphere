<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostUserController;
use App\Http\Controllers\PostController;

// Route::get('/', function () {
//     return view('layouts.app');
// });

// Route::get('/home', function () {
//     return view('postuser.index');
// });

Route::get('/', [PostUserController::class, 'index'])->name('postuser.index');
Route::get('/create', [PostUserController::class, 'create'])->name('postuser.create');
Route::post('/store', [PostUserController::class, 'store'])->name('postuser.store');
Route::get('/login', [PostUserController::class, 'login'])->name('postuser.login');
Route::post('/logincheck', [PostUserController::class, 'loginCheck'])->name('postuser.logincheck');
Route::get('/logout', [PostUserController::class, 'logout'])->name('postuser.logout');
Route::get('/{slug}/profile', [PostUserController::class, 'show'])->name('postuser.profile');
Route::get('/{slug}/edit', [PostUserController::class, 'edit'])->name('postuser.edit');
Route::put('/{slug}/update', [PostUserController::class, 'update'])->name('postuser.update');
Route::delete('/{slug}/delete', [PostUserController::class, 'destroy'])->name('postuser.delete');

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
Route::get('/post/show/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/post/edit/{slug}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/update/{slug}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/delete/{slug}', [PostController::class, 'destroy'])->name('post.delete');
