@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
    <form method="post" class="p-5" action="{{ route('postuser.logincheck') }}">
        @csrf 

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        
        <button type="submit" class="btn" style="background-color:#a1c2bd; color:#e7f2ef;">Login</button>

    </form>

    <hr>

    <p class="text-center py-3 m-0">
        Not registered? 
        <a href="{{ route('postuser.create') }}" class="text-primary fw-bold">Create an account</a>
    </p>

    <div class="container py-3">
        @if (session('error'))
            <div class="alert alert-danger m-0">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection