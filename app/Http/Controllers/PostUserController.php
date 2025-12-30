<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostUser;
use App\Models\Post;
// use App\Models\Comment;
use Illuminate\Support\Str;

class PostUserController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('postuser.index', compact('posts'));
    }

    public function create()
    {
        return view('postuser.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'profile' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'required|min:4',
        ]);

        $userData = $request->all();
        // dd( $user );

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile/'), $fileName);
            $userData['profile'] = $fileName;
        }

        $userData['slug'] = Str::slug($request->fullname, '-');
        $user = PostUser::create($userData);

        // ✅ Log user in
        // session(['user' => (object)$user->toArray()]);
        // session()->put('user', $user);
        session(['user' => $user]);

        // ✅ Check if pending comment exists
        if (session()->has('pending_comment')) {
            return redirect(session('pending_comment.redirect_url'))
                ->with('success', 'Registration successful. You can now submit your comment.');
        }

        return redirect()->route('postuser.index')->with('success', 'User created successfully.');
    }

    public function login()
    {
        return view('postuser.login');
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $user = PostUser::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if ($user) {

            // ✅ Store logged-in user in session
            // session(['user' => (object)$user->toArray()]);
            // session()->put('user', $user);
            // $request->session()->put('user', $user);
            session(['user' => $user]);

            // ✅ If user was trying to comment before login
            if (session()->has('pending_comment')) {
                return redirect(session('pending_comment.redirect_url'))
                    ->with('success', 'Login successful. You can now submit your comment.');
            }

            // ✅ Default redirect
            return redirect()->route('postuser.index')
                ->with('success', 'Login successful.');
        } else {
            return redirect()->back()
                ->with('error', 'Invalid email or password.')
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        // session()->forget('user');
        $request->session()->flush();
        return redirect()->route('postuser.index')->with('success', 'Logged out successfully.');
    }

    public function show($slug)
    {
        if (session()->has('user') == false) {
            return redirect()->route('postuser.login')->with('error', 'Please login to view profile.');
        }
        $user = PostUser::where('slug', $slug)->first();
        return view('postuser.show', compact('user'));
    }

    public function edit($slug)
    {
        if (session()->has('user') == false) {
            return redirect()->route('postuser.login')->with('error', 'Please login to view profile.');
        }
        $user = PostUser::where('slug', $slug)->first();
        return view('postuser.edit', compact('user'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'profile' => 'nullable',
            'password' => 'required|min:4',
        ]);

        $user = PostUser::where('slug', $slug)->first();
        $data = $request->all();

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile/'), $fileName);
            $data['profile'] = $fileName;
        } else {
            $data['profile'] = $user->profile;
        }

        $data['slug'] = Str::slug($request->fullname, '-');
        $user->update($data);
        // Update session user data
        $request->session()->put('user', $user);
        return redirect()->route('postuser.profile', [$data['slug']])->with('success', 'Profile updated successfully.');
    }

    public function destroy($slug)
    {
        $user = PostUser::where('slug', $slug)->first();
        $user->delete();
        return redirect()->route('postuser.index')->with('success', 'User deleted successfully.');
    }
}
