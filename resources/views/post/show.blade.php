@extends('layouts.app')

@section('title', 'Post Details')

@section('content')

<div class="container py-5">

    <!-- ================= POST CARD ================= -->
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow border-0 rounded-4 overflow-hidden">

                <img src="{{ asset('uploads/posts/' . $post->image) }}"
                     class="w-100"
                     style="height:280px; object-fit:cover;"
                     alt="Post Image">

                <div class="card-body p-4">
                    <h3 class="fw-bold mb-2">{{ $post->title }}</h3>
                    <p class="text-muted">{{ $post->description }}</p>

                    @if(session()->has('user') && session('user')->id == $post->post_user_id)
                        <div class="d-flex gap-2 mt-3">

                            <a href="{{ route('post.edit', $post->slug) }}"
                               class="btn btn-outline-warning">
                                Edit
                            </a>

                            <form action="{{ route('post.delete', $post->slug) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger"
                                        onclick="return confirm('Delete this post?')">
                                    Delete
                                </button>
                            </form>

                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>

    <!-- ================= COMMENT FORM ================= -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4 p-4">

                <h5 class="fw-semibold mb-3">Leave a Comment</h5>

                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <textarea name="comment"
                              rows="3"
                              class="form-control mb-3"
                              placeholder="Write your comment..."
                              required>{{ session('pending_comment.comment') ?? '' }}</textarea>

                    <button class="btn btn-modern">
                        Submit Comment
                    </button>

                    @if(!session()->has('user'))
                        <p class="text-muted small mt-2 mb-0">
                            🔒 Login required to submit comment.
                        </p>
                    @endif
                </form>

            </div>

        </div>
    </div>

    <!-- ================= FLASH MESSAGE ================= -->
    @if(session('success'))
        <div class="alert alert-success text-center mt-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- ================= COMMENTS LIST ================= -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">

            <h5 class="fw-bold mb-4">
                Comments ({{ $post->comments->count() }})
            </h5>

            @foreach($post->comments as $c)
                <div class="card mb-3 shadow-sm border-0 rounded-4">
                    <div class="card-body">

                        <strong>{{ $c->post_user?->fullname ?? 'Guest User' }}</strong>
                        <p class="mb-2 text-muted">{{ $c->comment }}</p>

                        @if(session()->has('user') && session('user')->id == $c->post_user_id)

                            <!-- Edit Form -->
                            <form action="{{ route('comment.update', $c->slug) }}"
                                  method="POST"
                                  class="edit-form mt-2"
                                  id="edit-form-{{ $c->slug }}">
                                @csrf
                                @method('PUT')

                                <textarea name="comment"
                                          rows="2"
                                          class="form-control mb-2">{{ $c->comment }}</textarea>

                                <button class="btn btn-sm btn-success">
                                    Update
                                </button>
                            </form>

                            <div class="d-flex gap-2 mt-2">
                                <button type="button"
                                        class="btn btn-sm btn-warning editcomment"
                                        data-comment-id="{{ $c->slug }}">
                                    Edit
                                </button>

                                <form action="{{ route('comment.delete', $c->slug) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        @endif

                    </div>
                </div>
            @endforeach

        </div>
    </div>

</div>

<!-- ================= SCRIPT ================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function () {
        $(".edit-form").hide();

        $(".editcomment").click(function () {
            let id = $(this).data('comment-id');

            $(".edit-form").hide();
            $(".editcomment").show();

            $(this).hide();
            $("#edit-form-" + id).slideDown();
        });
    });
</script>

@endsection

