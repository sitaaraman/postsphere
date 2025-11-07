@extends('layouts.app')

@section('title', 'index')

@section('content')

    <h3 class="text-center py-5 m-0">Post User Index Page</h3>

    <div class="container p-2">
        @if (session('success'))
            <div class="alert alert-success m-0">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection