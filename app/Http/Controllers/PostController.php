<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostUser;

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

    public function show($slug){
        $post = Post::with('post_user')->where('slug', $slug)->first();
        return view('post.show', compact('post'));
    }

    public function edit($slug){

        if(!session()->has('user')){
            return redirect()->route('postuser.login')->with('error','Please login to edit a post.');
        }

        if(session()->get('user')->id != Post::where('slug', $slug)->first()->post_user_id){
            return redirect()->route('postuser.index')->with('error','You are not authorized to edit this post.');
        }

        $post = Post::where('slug', $slug)->first();
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $slug){

        if(!session()->has('user')){
            return redirect()->route('postuser.login')->with('error','Please login to create a post.');

        }
        if(session()->get('user')->id != Post::where('slug', $slug)->first()->post_user_id){
            return redirect()->route('postuser.index')->with('error','You are not authorized to update this post.');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post = Post::where('slug', $slug)->first();
        $oldImg = $post['image'];

        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName=time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/posts/'),$fileName);
            $post->image=$fileName;
        }else{
            $post->image = $oldImg;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        // $post->image = $post->image;
        $post->slug = \Str::slug($request->title, '-');
        $post->save();

        return redirect()->route('postuser.index')->with('success','Post updated successfully.');
    }

    public function destroy($slug){

        if(!session()->has('user')){
            return redirect()->route('postuser.login')->with('error','Please login to delete a post.');
        }

        if(session()->get('user')->id != Post::where('slug', $slug)->first()->post_user_id){
            return redirect()->route('postuser.index')->with('error','You are not authorized to delete this post.');
        }

        $post = Post::where('slug', $slug)->first();
        $post->delete();
        return redirect()->route('postuser.index')->with('success','Post deleted successfully.');
    }
}
