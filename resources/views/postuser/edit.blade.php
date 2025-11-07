@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <form method="post" class="p-5" action="{{ route('postuser.update', $user->slug) }}" enctype="multipart/form-data">
        @csrf 
        @method('PUT')

        <div class="mb-3">
            <label for="fullname" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $user->fullname }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="mb-3">
            <label for="profile" class="form-label">Your Profile</label>
            <input type="file" class="form-control" id="profile" name="profile">
            <img src="{{ asset('uploads/profile/' . $user->profile) }}" alt="Current Profile" class="mt-3" style="width: 100px; height: 100px; object-fit: cover;">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}">
        </div>
        <button type="submit" class="btn" style="background-color:#19183b; color:#e7f2ef;">Update</button>
    </form>

@endsection