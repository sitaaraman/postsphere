@extends('layouts.app')

@section('title', 'index')

@section('content')

    <h3 class="text-center py-5 m-0">Post User Index Page</h3>

    <div class="container d-flex justify-content-between pb-5">
        @foreach ($posts as $p)
            <div class="card" style="width: 18rem;">
                <a href="{{ route('post.show', [$p->slug]) }}">
                    <img src="{{ asset('uploads/posts/' . $p->image) }}" class="card-img-top" alt="Post Image" style="height: 12rem; object-fit: cover;">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $p->title }}</h5>
                    <p class="card-text">{{ $p->description }}</p>
                </div>
            </div> 
        @endforeach
    </div>

    <span>{{ $posts->links() }}</span>

    <div class="container py-3">
        @if (session('success'))
            <div class="alert alert-success m-0">
                {{ session('success') }}
            </div>
        @endif
    </div>

@endsection