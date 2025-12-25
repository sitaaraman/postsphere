<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostUser;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = PostUser::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        PostUser::findOrFail($id)->delete();
        return back()->with('success', 'User deleted');
    }
}
