@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
    <form method="post" class="p-5" action="{{ route('postuser.logincheck') }}">
        @csrf 

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        
        <button type="submit" class="btn" style="background-color:#a1c2bdff">Login</button>

    </form>

    <hr>

    <p class="text-center py-3 m-0">
        Not registered? 
        <a href="{{ route('postuser.create') }}" class="text-primary fw-bold">Create an account</a>
    </p>

    @if (session('error'))
            <div class="alert alert-danger m-0">
                {{ session('error') }}
            </div>
    @endif
@endsection