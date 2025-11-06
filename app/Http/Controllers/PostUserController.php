<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('postuser.create');
    }
}
