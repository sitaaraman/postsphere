@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <div class="container py-5">
        <h2 class="text-center fw-bold mb-5">Latest Posts</h2>

        <div class="row g-4 justify-content-center">
            @foreach ($posts as $p)
                <div class="col-md-4">
                    <div class="card mod-card">

                        <img src="{{ asset('uploads/posts/' . $p->image) }}" class="card-img-top"
                            style="height:220px;object-fit:cover;">

                        <div class="card-body">
                            <h5 class="fw-bold">{{ $p->title }}</h5>
                            <p class="text-muted">{{ Str::limit($p->description, 30) }}</p>

                            <button class="btn btn-modern w-100" data-bs-toggle="modal"
                                data-bs-target="#postModal{{ $p->id }}">
                                View Post
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade mod-modal" id="postModal{{ $p->id }}">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">{{ $p->title }}</h5>
                                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <img src="{{ asset('uploads/posts/' . $p->image) }}" class="img-fluid rounded mb-3">
                                <p>{{ $p->description }}</p>
                            </div>

                            <div class="modal-footer">
                                <a href="{{ route('post.show', $p->slug) }}" class="btn btn-modern">
                                    Open Full Page
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>

@endsection
