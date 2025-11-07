@extends('layouts.app')

@section('title', 'Profile Page')

@section('content')

    <h3 class="text-center py-5 m-0">Post User Profile Page</h3>
    @if (session()->has('user'))
    <div class="container d-flex justify-content-center pb-5">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('uploads/profile/' . $user->profile) }}" class="card-img-top" alt="User Profile">
            <div class="card-body">
                <h5 class="card-title">{{ $user->fullname }}</h5>
                <p class="card-text">{{ $user->email }}</p>
                <a href="{{ route('postuser.edit', [session('user')->slug]) }}" class="btn" style="background-color:#a1c2bd; color:#e7f2ef;">Edit Profile</a>
            </div>
        </div> 
    </div>   
    @endif
    

@endsection