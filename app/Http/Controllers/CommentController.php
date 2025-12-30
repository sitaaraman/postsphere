<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
// use App\Models\Post;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (!session()->has('user')) {

            session([
                'pending_comment' => [
                    'post_id' => $request->post_id,
                    'comment' => $request->comment,
                    'redirect_url' => url()->previous()
                ]
            ]);

            return redirect()
                ->route('postuser.login')
                ->with('error', 'Please login to submit a comment.');
        }

        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string',
        ]);

        $commentData = $request->all();
        // dd( $commentData );
        $commentData['post_user_id'] = session()->get('user')->id;
        $commentData['slug'] = Str::slug(substr($request->comment, 0, 20) . '-' . time(), '-');

        Comment::create($commentData);
        session()->forget('pending_comment');

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function update(Request $request, $slug)
    {
        if (!session()->has('user')) {
            return redirect()->route('postuser.login')->with('error', 'Please login to update a comment.');
        }

        $comment = Comment::where('slug', $slug)->first();

        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        if ($comment->post_user_id != session()->get('user')->id) {
            return redirect()->back()->with('error', 'You are not authorized to update this comment.');
        }

        $request->validate([
            'comment' => 'required'
        ]);

        $comment->update([
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function destroy($slug)
    {
        if (!session()->has('user')) {
            return redirect()->route('postuser.login')->with('error', 'Please login to delete a comment.');
        }

        $comment = Comment::where('slug', $slug)->first();

        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        if ($comment->post_user_id != session()->get('user')->id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
