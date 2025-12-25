@extends('admin.layouts.app')

@section('content')
<h3 class="mb-3">Users</h3>

<table class="table table-bordered table-hover bg-white shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Profile</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <img src="{{ asset('uploads/profile/'.$user->profile) }}" width="40">
            </td>
            <td>
                <form method="POST" action="{{ url('admin/users/'.$user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this user?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
