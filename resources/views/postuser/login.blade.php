@extends('layouts.app')
@section('title', 'Login')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card mod-card p-4">
                    <h4 class="fw-bold text-center mb-4">Welcome Back</h4>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="post" action="{{ route('postuser.logincheck') }}">
                        @csrf

                        <input class="form-control mb-3" type="email" name="email" placeholder="Email">
                        <input class="form-control mb-3" type="password" name="password" placeholder="Password">

                        <button class="btn btn-modern w-100">Login</button>
                    </form>

                    <p class="text-center mt-3">
                        New user?
                        <a href="{{ route('postuser.create') }}" class="fw-bold text-decoration-none">Create account</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

@endsection
