<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Mabarin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand bg-white border-bottom px-4 py-2 shadow-sm d-flex justify-content-between align-items-center sticky-top">

    <div class="d-flex align-items-center">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 me-4" href="{{ route('dashboard') }}">
            <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 14px;">🎮</div>
            <span class="fw-bold text-dark m-0" style="font-size: 1.1rem; letter-spacing: -0.5px;">Mabarin</span>
        </a>

    
        <div class="navbar-nav gap-1" style="font-size: 0.875rem; font-weight: 500;">
            <a class="nav-link px-3 py-1.5 rounded-3 transition {{ request()->routeIs('dashboard') ? 'bg-primary bg-opacity-10 text-primary fw-bold' : 'text-secondary' }}" href="{{ route('dashboard') }}">
                Dashboard
            </a>
            <a class="nav-link px-3 py-1.5 rounded-3 transition {{ request()->is('users*') ? 'bg-primary bg-opacity-10 text-primary fw-bold' : 'text-secondary' }}" href="{{ url('/users') }}">
                Users
            </a>
            <a class="nav-link px-3 py-1.5 rounded-3 transition {{ request()->is('pelanggan*') ? 'bg-primary bg-opacity-10 text-primary fw-bold' : 'text-secondary' }}" href="{{ url('/pelanggan') }}">
                Pelanggan
            </a>
            <a class="nav-link px-3 py-1.5 rounded-3 transition {{ request()->is('ruangan*') ? 'bg-primary bg-opacity-10 text-primary fw-bold' : 'text-secondary' }}" href="{{ route('ruangan.index') }}">
                Ruangan
            </a>
            <a class="nav-link px-3 py-1.5 rounded-3 transition {{ request()->is('booking*') ? 'bg-primary bg-opacity-10 text-primary fw-bold' : 'text-secondary' }}" href="{{ url('/booking') }}">
                Booking
            </a>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3">
      
        <div class="d-flex align-items-center px-3 py-1.5 bg-light rounded-pill border" style="font-size: 0.75rem; font-weight: 600;">
            <span class="bg-success rounded-circle me-2" style="width: 8px; height: 8px;"></span>
            <span class="text-secondary">{{ auth()->user()->name ?? 'Admin' }}</span>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button class="btn btn-sm text-danger border border-danger-subtle bg-light hover-bg-danger rounded-3 px-3 py-1.5 fw-bold" style="font-size: 0.75rem;">
                Logout
            </button>
        </form>
    </div>

</nav>

<div class="container mt-4 flex-grow-1">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

</div>

<footer class="container py-4 mt-5 border-top d-flex justify-content-between align-items-center text-secondary" style="font-size: 0.75rem;">
    <p class="mb-0">&copy; 2026 Mabarin PlayStation Lounge Management</p>
    <p class="mb-0">System Rental v1.0</p>
</footer>

</body>
</html>