<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostUser;

class PostUserController extends Controller
{
    public function index(){
        return view('postuser.index');
    }

    public function create(){
        return view('postuser.create');
    }

    public function store(Request $request){

        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'profile' => 'required',
            'password' => 'required|min:4',
        ]);

        $user = $request->all();
        // dd( $user );

        if($request->hasFile('profile')){
            $file=$request->file('profile');
            $fileName=time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/profile/'),$fileName);
            $user['profile']=$fileName;
        }

        $user['slug'] = \Str::slug($request->fullname, '-');
        PostUser::create($user);
        return redirect()->route('postuser.login')->with('success','User created successfully.');
    }

    public function login(){
        return view('postuser.login');
    }

    public function loginCheck(Request $request){
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $user = PostUser::where('email', $request->email)
                        ->where('password', $request->password)
                        ->first();
                
        if($user){
            $request->session()->put('user', $user);
            return redirect()->route('postuser.index')->with('success','Login successful.');
        }else{
            return redirect()->back()->with('error','Invalid email or password.')->withInput(); 
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('postuser.index')->with('success','Logged out successfully.');
    }

    public function show($slug){
        if(session()->has('user') == false){
            return redirect()->route('postuser.login')->with('error','Please login to view profile.');
        }
        $user = PostUser::where('slug', $slug)->first();
        return view('postuser.show', compact('user'));
    }

    public function edit($slug){
        if(session()->has('user') == false){
            return redirect()->route('postuser.login')->with('error','Please login to view profile.');
        }
        $user= PostUser::where('slug', $slug)->first();
        return view('postuser.edit', compact('user'));
    }

    public function update(Request $request, $slug){
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'profile' => 'nullable',
            'password' => 'required|min:4',
        ]);

        $user = PostUser::where('slug', $slug)->first();
        $data = $request->all();

        if($request->hasFile('profile')){
            $file=$request->file('profile');
            $fileName=time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/profile/'),$fileName);
            $data['profile']=$fileName;
        } else {
            $data['profile'] = $user->profile;
        }

        $data['slug'] = \Str::slug($request->fullname, '-');
        $user->update($data);
        // Update session user data
        $request->session()->put('user', $user);
        return redirect()->route('postuser.profile', [$data['slug']])->with('success','Profile updated successfully.');
    }

    public function destroy($slug){
        $user = PostUser::where('slug', $slug)->first();
        $user->delete();
        return redirect()->route('postuser.index')->with('success','User deleted successfully.');
    }
}
