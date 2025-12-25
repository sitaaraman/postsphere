@extends('admin.layouts.app')

@section('content')
<h3 class="mb-3">Comments</h3>

<table class="table table-bordered table-hover bg-white shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Comment</th>
            <th>User</th>
            <th>Post</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($comments as $comment)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ Str::limit($comment->comment, 50) }}</td>
            <td>{{ $comment->post_user->fullname ?? 'N/A' }}</td>
            <td>{{ $comment->post->title ?? 'Deleted' }}</td>
            <td>
                <form method="POST" action="{{ url('admin/comments/'.$comment->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this comment?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
