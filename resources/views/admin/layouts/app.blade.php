<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f4f6f9; }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #212529;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="d-flex">

    {{-- Sidebar --}}
    <div class="sidebar">
        <h5 class="text-white text-center py-3">Admin Panel</h5>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.users') }}">Users</a>
        <a href="{{ route('admin.posts') }}">Posts</a>
        <a href="{{ route('admin.comments') }}">Comments</a>

        <hr class="text-secondary">

        <a href="{{ route('admin.logout') }}" class="text-danger">Logout</a>
    </div>

    {{-- Main Content --}}
    <div class="flex-fill p-4">
        @yield('content')
    </div>

</div>

</body>
</html>
