<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post', 'post_user')->latest()->get();
        return view('admin.comments.index', compact('comments'));
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return back()->with('success', 'Comment deleted');
    }
}
