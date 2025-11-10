<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // public function index(){
    //     return view('post.index');
    // }

    public function create(){
        return view('post.create');
    }

    public function store(Request $request){

        if(!session()->has('user')){
            return redirect()->route('postuser.login')->with('error','Please login to create a post.');

        }else{
                $request->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',
            ]);

            $request->merge(['post_user_id' => session()->get('user')->id]);

            $post = $request->all();
            // dd( $post );

            if($request->hasFile('image')){
                $file=$request->file('image');
                $fileName=time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/posts/'),$fileName);
                $post['image']=$fileName;
            }
            $post['slug'] = \Str::slug($request->title, '-');
            Post::create($post);
            return redirect()->route('postuser.index')->with('success','Post created successfully.');
        }

        
    }
}
