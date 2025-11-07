@extends('layouts.app')

@section('title', 'registration')

@section('content')
    <form method="post" class="p-5" action="{{ route('postuser.store') }}" enctype="multipart/form-data">
        @csrf 

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Your Profile</label>
            <input type="file" class="form-control" id="profile" name="profile">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        
        <button type="submit" class="btn" style="background-color:#a1c2bdff">Submit</button>

    </form>

    <hr>
        <p class="text-center py-3 m-0">
            Already registered?
            <a href="{{ route('postuser.login') }}" class="text-primary fw-bold">Login here</a>
        </p>
@endsection