<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Rental PS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Rental PS</a>
    <div class="navbar-nav me-auto">
        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="nav-link" href="{{ url('/users') }}">Users</a>
        <a class="nav-link" href="{{ url('/pelanggan') }}">Pelanggan</a>
        <a class="nav-link" href="{{ url('/konsol') }}">Konsol</a>
        <a class="nav-link" href="{{ url('/booking') }}">Booking</a>
    </div>
    <span class="navbar-text me-3">{{ auth()->user()->name }}</span>
    <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button class="btn btn-outline-light btn-sm">Logout</button>
    </form>
</nav>

<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>