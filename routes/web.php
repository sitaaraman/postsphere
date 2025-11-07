<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostUserController;

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
