@extends('admin.layouts.app')

@section('content')
<h3 class="mb-4">Dashboard</h3>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-bg-primary text-center p-3">
            <h5>Users</h5>
            <h2>{{ $totalUsers }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-success text-center p-3">
            <h5>Posts</h5>
            <h2>{{ $totalPosts }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-warning text-center p-3">
            <h5>Comments</h5>
            <h2>{{ $totalComments }}</h2>
        </div>
    </div>
</div>

<div class="card p-4">
    <canvas id="dashboardChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('dashboardChart'), {
    type: 'bar',
    data: {
        labels: ['Users', 'Posts', 'Comments'],
        datasets: [{
            label: 'Platform Data',
            data: [{{ $totalUsers }}, {{ $totalPosts }}, {{ $totalComments }}],
            backgroundColor: ['#0d6efd', '#198754', '#ffc107']
        }]
    }
});
</script>
@endsection
