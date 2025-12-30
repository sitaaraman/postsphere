<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f8fafc, #eef2ff);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, .9);
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        .nav-link {
            color: #0f172a !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #4f46e5 !important;
        }

        /* Logo */
        .logo-text {
            font-weight: 800;
            font-size: 1.4rem;
            color: #4f46e5;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
        }

        /* Buttons */
        .btn-modern {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-modern:hover {
            opacity: .9;
        }

        /* Cards */
        .mod-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .mod-card:hover {
            transform: translateY(-5px);
        }

        /* Inputs */
        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        /* Modal */
        .mod-modal .modal-content {
            border-radius: 20px;
            border: none;
        }

        .mod-modal .modal-header {
            background: #4f46e5;
            color: white;
            border-radius: 20px 20px 0 0;
        }

        footer a:hover {
            color: #adb5ff !important;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- 🔷 NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <!-- 🔷 LOGO -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('postuser.index') }}">

                <!-- SVG LOGO ICON -->
                <svg class="logo-icon" viewBox="0 0 64 64" fill="none">
                    <defs>
                        <linearGradient id="g1" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#4f46e5" />
                            <stop offset="100%" stop-color="#6366f1" />
                        </linearGradient>
                    </defs>

                    <rect x="10" y="14" width="34" height="38" rx="6" fill="url(#g1)" opacity="0.85" />
                    <rect x="20" y="8" width="34" height="38" rx="6" fill="url(#g1)" />

                    <rect x="26" y="18" width="18" height="4" rx="2" fill="white" />
                    <rect x="26" y="26" width="24" height="4" rx="2" fill="white" />
                    <rect x="26" y="34" width="14" height="4" rx="2" fill="white" />
                </svg>

                <span class="logo-text">PostSphere</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('postuser.index') }}">Home</a>
                    </li>
                    {{-- {{ gettype(session('user')) }} --}}

                    {{-- NOT LOGGED IN --}}
                    @if (!session()->has('user'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('postuser.login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-modern" href="{{ route('postuser.create') }}">
                                Register
                            </a>
                        </li>
                    @endif

                    {{-- LOGGED IN --}}
                    @if (session()->has('user'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                                data-bs-toggle="dropdown">

                                <img src="{{ asset('uploads/profile/' . session('user')->profile) }}"
                                    class="rounded-circle" style="width:32px;height:32px;object-fit:cover;">

                                {{ session('user')->fullname }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('postuser.profile', session('user')->slug) }}">
                                        My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('postuser.edit', session('user')->slug) }}">
                                        Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('postuser.logout') }}">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div style="padding-top:95px;">
        @yield('content')
    </div>

    <footer class="mt-auto bg-dark text-light pt-5 pb-3">
        <div class="container">

            <div class="row gy-4">

                <!-- Brand / Logo -->
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('postuser.index') }}">

                            <!-- SVG LOGO ICON -->
                            <svg class="logo-icon" viewBox="0 0 64 64" fill="none">
                                <defs>
                                    <linearGradient id="g1" x1="0" y1="0" x2="1"
                                        y2="1">
                                        <stop offset="0%" stop-color="#4f46e5" />
                                        <stop offset="100%" stop-color="#6366f1" />
                                    </linearGradient>
                                </defs>

                                <rect x="10" y="14" width="34" height="38" rx="6" fill="url(#g1)"
                                    opacity="0.85" />
                                <rect x="20" y="8" width="34" height="38" rx="6" fill="url(#g1)" />

                                <rect x="26" y="18" width="18" height="4" rx="2" fill="white" />
                                <rect x="26" y="26" width="24" height="4" rx="2" fill="white" />
                                <rect x="26" y="34" width="14" height="4" rx="2" fill="white" />
                            </svg>

                            <span class="logo-text">PostSphere</span>
                        </a>
                        
                    </div>
                    <p class="text-muted small">
                        A modern post & comment platform built with Laravel.
                        Share your thoughts and connect with others easily.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4">
                    <h6 class="fw-semibold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('postuser.index') }}" class="text-decoration-none text-light">
                                Home
                            </a>
                        </li>

                        @if (session()->has('user'))
                            <li class="mb-2">
                                <a href="{{ route('postuser.profile', session('user')->slug) }}"
                                    class="text-decoration-none text-light">
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('postuser.logout') }}" class="text-decoration-none text-danger">
                                    Logout
                                </a>
                            </li>
                        @else
                            <li class="mb-2">
                                <a href="{{ route('postuser.login') }}" class="text-decoration-none text-light">
                                    Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('postuser.create') }}" class="text-decoration-none text-light">
                                    Register
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Contact / Info -->
                <div class="col-md-4">
                    <h6 class="fw-semibold mb-3">Contact</h6>
                    <p class="mb-1 small">Email: support@postsphere.com</p>
                    <p class="mb-1 small">Phone: +91 98765 42317</p>
                    <p class="small">India</p>
                </div>

            </div>

            <hr class="border-secondary mt-4">

            <div class="text-center small">
                © {{ date('Y') }} PostSphere. All rights reserved.
            </div>

        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
