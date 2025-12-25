<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostUser;
use App\Models\Post;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => PostUser::count(),
            'totalPosts' => Post::count(),
            'totalComments' => Comment::count(),
        ]);
    }
}
