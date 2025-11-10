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

                    <div class="d-flex justify-content-around mt-3">
                    <a href="{{ route('postuser.edit', [session('user')->slug]) }}" class="btn" style="background-color:#19183b; color:#e7f2ef;">Edit Profile</a>
                        <form method="post" action="{{ route('postuser.delete', [session('user')->slug]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Profile</button>
                        </form> 
                    </div>
                </div>
            </div> 
        </div>   
    @endif
    

@endsection