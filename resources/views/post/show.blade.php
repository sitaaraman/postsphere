@extends('layouts.app')

@section('title', 'Post Show')

@section('content')

    <div class="container d-flex justify-content-center py-5">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('uploads/posts/' . $post->image) }}" class="card-img-top" alt="Post Image">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p> 
                    @if (session()->has('user') && session('user')->id == $post->post_user_id)
                    
                        <a href="{{ route('post.edit', [$post->slug]) }}" class="btn btn-warning">Edit</a>  

                        <form action="{{ route('post.delete', [$post->slug]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger">Delete</button>
                        </form>
                    @endif

                    

            </div>
        </div> 
    </div>

@endsection