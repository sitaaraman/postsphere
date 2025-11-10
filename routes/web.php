<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostUserController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('layouts.app');
});

// Route::get('/home', function () {
//     return view('postuser.index');
// });

Route::get('/postuser', [PostUserController::class, 'index'])->name('postuser.index');
Route::get('/postuser/create', [PostUserController::class, 'create'])->name('postuser.create');
Route::post('/postuser/store', [PostUserController::class, 'store'])->name('postuser.store');
Route::get('/postuser/login', [PostUserController::class, 'login'])->name('postuser.login');
Route::post('/postuser/logincheck', [PostUserController::class, 'loginCheck'])->name('postuser.logincheck');
Route::get('/postuser/logout', [PostUserController::class, 'logout'])->name('postuser.logout');
Route::get('/postuser/{slug}/profile', [PostUserController::class, 'show'])->name('postuser.profile');
Route::get('/postuser/{slug}/edit', [PostUserController::class, 'edit'])->name('postuser.edit');
Route::put('/postuser/{slug}/update', [PostUserController::class, 'update'])->name('postuser.update');
Route::delete('/postuser/{slug}/delete', [PostUserController::class, 'destroy'])->name('postuser.delete');

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
