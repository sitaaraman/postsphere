@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="container py-5">

    <h2 class="text-center fw-bold mb-4">My Profile</h2>

    @if (session()->has('user'))

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">

            <div class="card shadow-lg border-0 rounded-4">

                <!-- Profile Image -->
                <div class="text-center pt-4">
                    <img src="{{ asset('uploads/profile/' . $user->profile) }}"
                         class="rounded-circle shadow"
                         style="width:120px; height:120px; object-fit:cover;"
                         alt="User Profile">
                </div>

                <!-- Profile Details -->
                <div class="card-body text-center">
                    <h4 class="fw-semibold mt-3">{{ $user->fullname }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>

                    <div class="d-flex justify-content-center gap-2">

                        <!-- Edit -->
                        <a href="{{ route('postuser.edit', session('user')->slug) }}"
                           class="btn btn-modern px-4">
                           Edit Profile
                        </a>

                        <!-- Delete -->
                        <form method="post"
                              action="{{ route('postuser.delete', session('user')->slug) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger px-4"
                                    onclick="return confirm('Are you sure you want to delete your profile?')">
                                Delete
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>

    @else
        <div class="alert alert-warning text-center">
            Please login to view your profile.
        </div>
    @endif

</div>

@endsection
