<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminCommentController;

/*
|--------------------------------------------------------------------------
| Admin Auth Routes (NO middleware here)
|--------------------------------------------------------------------------
*/
Route::get('login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('login', [AdminAuthController::class, 'loginCheck'])->name('admin.login.check');

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('adminAuth')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::delete('users/{id}', [AdminUserController::class, 'destroy']);

    Route::get('posts', [AdminPostController::class, 'index'])->name('admin.posts');
    Route::delete('posts/{id}', [AdminPostController::class, 'destroy']);

    Route::get('comments', [AdminCommentController::class, 'index'])->name('admin.comments');
    Route::delete('comments/{id}', [AdminCommentController::class, 'destroy']);
});
