@extends('layouts.app')

@section('title', 'Post Create')

@section('content')

    <form method="post" class="p-5" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf 

        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control" id="title" name="title" >
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Post Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Post Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn" style="background-color:#19183b; color:#e7f2ef;">Create Post</button>
    </form>

@endsection