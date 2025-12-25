<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('post_user')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return back()->with('success', 'Post deleted');
    }
}
