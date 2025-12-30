@extends('layouts.app')
@section('title', 'Register')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card mod-card p-4">
                    <h4 class="fw-bold text-center mb-4">Create Account</h4>

                    <form method="post" action="{{ route('postuser.store') }}" enctype="multipart/form-data">
                        @csrf

                        <input class="form-control mb-3" name="fullname" placeholder="Full Name">
                        <input class="form-control mb-3" name="email" placeholder="Email Address">
                        <input class="form-control mb-3" type="file" name="profile">
                        <input class="form-control mb-3" type="password" name="password" placeholder="Password">

                        <button class="btn btn-modern w-100">Register</button>
                    </form>

                    <p class="text-center mt-3">
                        Already registered?
                        <a href="{{ route('postuser.login') }}" class="fw-bold text-decoration-none">Login</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

@endsection
