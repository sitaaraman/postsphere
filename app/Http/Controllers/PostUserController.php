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
        return redirect()->route('postuser.index')->with('success','User created successfully.');
    }
}
