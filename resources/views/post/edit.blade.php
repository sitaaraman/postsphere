@extends('layouts.app')

@section('title', 'Post Edit')

@section('content')

    <form method="post" class="p-5" action="{{ route('post.update', [$post->slug]) }}" enctype="multipart/form-data">
        @csrf 
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Post Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $post->description }}</textarea>
        </div>
        <small>Current Image:</small>
        <div class="card mx-auto my-3" style="width: 28rem;">
            <img src="{{ asset('uploads/posts/'.$post->image) }}" alt="Post Image" class="card-img-top">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Post Image</label>
            <input type="file" class="form-control" id="image" name="image">
            
        </div>
        
        <button type="submit" class="btn" style="background-color:#19183b; color:#e7f2ef;">Update Post</button>

    </form>

@endsection