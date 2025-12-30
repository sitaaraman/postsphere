@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card mod-card p-4">
                    <h4 class="fw-bold text-center mb-4">Edit Profile</h4>

                    <form method="post" action="{{ route('postuser.update', $user->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input class="form-control mb-3" name="fullname" value="{{ $user->fullname }}">
                        <input class="form-control mb-3" name="email" value="{{ $user->email }}">

                        <input class="form-control mb-2" type="file" name="profile">
                        <img src="{{ asset('uploads/profile/' . $user->profile) }}" class="rounded mb-3" width="100">

                        <input class="form-control mb-3" type="password" name="password" placeholder="New Password" value="{{ $user->password }}">

                        <button class="btn btn-modern w-100">Update Profile</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
