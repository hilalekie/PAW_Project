@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h3 class="mb-4">Dashboard</h3>

    <p>Selamat datang, {{ auth()->user()->name }}!</p>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Pelanggan</h5>
                <h2>{{ $totalPelanggan ?? 0 }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Konsol</h5>
                <h2>{{ $totalKonsol ?? 0 }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Booking</h5>
                <h2>{{ $totalBooking ?? 0 }}</h2>
            </div>
        </div>
    </div>
@endsection