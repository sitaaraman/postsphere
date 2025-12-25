@extends('admin.layouts.app')

@section('content')
<h3 class="mb-3">Posts</h3>

<table class="table table-bordered table-hover bg-white shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>User</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->post_user->fullname ?? 'N/A' }}</td>
            <td>
                <img src="{{ asset('uploads/posts/'.$post->image) }}" width="60">
            </td>
            <td>
                <form method="POST" action="{{ url('admin/posts/'.$post->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this post?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
