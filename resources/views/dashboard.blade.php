@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Import Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .card-stat {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        border-radius: 0.75rem;
    }
    .card-stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
    }
    .icon-box {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.6rem;
    }
    .hover-shadow:hover {
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
    }
</style>

<div class="container-fluid py-2">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-2 border-bottom">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Dashboard Overview</h3>
            <p class="text-muted mb-0">Selamat datang kembali, <strong class="text-primary">{{ auth()->user()->name }}</strong>! 👋</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <a href="{{ route('booking.create') }}" class="btn btn-primary px-3 shadow-sm rounded-3">
                <i class="bi bi-plus-circle me-1"></i> Tambah Booking
            </a>
        </div>
    </div>

    
    <div class="row g-3 mb-4">
        
        <div class="col-md-4">
            <div class="card card-stat shadow-sm p-3 bg-white h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold fs-7 d-block mb-1">Total Pelanggan</span>
                        <h2 class="fw-bold text-dark mb-0">{{ number_format($totalPelanggan ?? 0) }}</h2>
                        <small class="text-success fw-medium">
                            <i class="bi bi-person-check me-1"></i> Terdaftar di sistem
                        </small>
                    </div>
                    <div class="icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card card-stat shadow-sm p-3 bg-white h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold fs-7 d-block mb-1">Total Ruangan</span>
                        <h2 class="fw-bold text-dark mb-0">{{ number_format($totalRuangan ?? 0) }}</h2>
                        <small class="text-info fw-medium">
                            <i class="bi bi-door-open-fill me-1"></i> Ruangan PlayStation
                        </small>
                    </div>
                    <div class="icon-box bg-info bg-opacity-10 text-info">
                        <i class="bi bi-controller fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card card-stat shadow-sm p-3 bg-white h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold fs-7 d-block mb-1">Total Booking</span>
                        <h2 class="fw-bold text-dark mb-0">{{ number_format($totalBooking ?? 0) }}</h2>
                        <small class="text-warning fw-medium">
                            <i class="bi bi-calendar2-check-fill me-1"></i> Riwayat sewa
                        </small>
                    </div>
                    <div class="icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-journal-check fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-3">
        <!-- Quick Nav Menu -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-3 h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                        <i class="bi bi-grid-fill fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Pintasan Menu Rental PS</h5>
                        <p class="text-muted mb-0 small">Akses cepat kelola data pelanggan, ruangan, dan transaksi.</p>
                    </div>
                </div>
                <hr class="my-3 text-muted">
                <div class="row text-center g-3 mt-1">
                    <div class="col-4">
                        <a href="{{ route('pelanggan.index') }}" class="text-decoration-none text-dark d-block p-3 rounded-3 bg-light hover-shadow">
                            <i class="bi bi-person-lines-fill text-primary fs-2 d-block mb-1"></i>
                            <span class="fw-medium small">Pelanggan</span>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('ruangan.index') }}" class="text-decoration-none text-dark d-block p-3 rounded-3 bg-light hover-shadow">
                            <i class="bi bi-house-door-fill text-info fs-2 d-block mb-1"></i>
                            <span class="fw-medium small">Ruangan</span>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('booking.index') }}" class="text-decoration-none text-dark d-block p-3 rounded-3 bg-light hover-shadow">
                            <i class="bi bi-receipt text-warning fs-2 d-block mb-1"></i>
                            <span class="fw-medium small">Booking</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-3 h-100">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="bi bi-shield-lock-fill text-primary me-2"></i>Status Akun Admin
                </h5>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                        <span class="text-muted">Nama</span>
                        <span class="fw-semibold">{{ auth()->user()->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                        <span class="text-muted">Email</span>
                        <span class="fw-semibold">{{ auth()->user()->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                        <span class="text-muted">Status</span>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1">Aktif</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection