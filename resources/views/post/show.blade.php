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

    <hr>

    <div class="container d-flex justify-content-center card px-0">
        @if(session()->has('user'))
            <form action="{{ route('comment.store') }}" method="POST" class="mb-3">
                @csrf 
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea name="comment" rows="3" class="form-control mb-2" placeholder="Write your comment..."></textarea>
                <button type="submit" class="btn btn-success ms-3">Comment</button>
            </form>
        @endif
    </div>

    <div class="container py-3">
        @if (session('success'))
            <div class="alert alert-success m-0">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <hr>

    <h5 class="m-0 pb-3">Comments ({{ $post->comments->count() }})</h5>

    @foreach($post->comments as $c)
        <div class="container py-3">

            <strong>{{ $c->post_user->fullname }}</strong>:
            <p>{{ $c->comment }}</p> 

            @if(session()->has('user') && session('user')->id == $c->post_user_id)
                <form action="{{ route('comment.update' , $c->slug) }}" method="POST" class="edit-form" id="edit-form-{{ $c->slug }}">
                    @csrf
                    @method('PUT')
                    
                    <textarea name="comment" rows="1" class="form-control">{{ $c->comment }}</textarea>
                    
                    <button class="btn btn-success mt-2">Update Comment</button>
                </form>
            
                <span class="editcomment btn btn-warning mt-2" data-comment-id="{{ $c->slug }}">Edit Comment</span>
                
                <form action="{{ route('comment.delete' , [$c->slug]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mt-2">Delete Comment</button>
                </form>
            @endif

        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script>
            $(document).ready(function(){

                $(".edit-form").hide();

                $(".editcomment").click(function(){
                    var commentId = $(this).data('comment-id');

                    $(".edit-form").hide();
                    $(".editcomment").show();

                    $(".editcomment").show();

                    $(this).hide();

                    $("#edit-form-" + commentId).toggle();

                    $("#comment-" + commentId + " .btn-danger").show();
                });
            });
        </script>

@endsection