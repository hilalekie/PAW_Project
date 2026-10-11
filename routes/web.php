<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'totalPelanggan' => \App\Models\Pelanggan::count(),
            'totalKonsol' => \App\Models\Konsol::count(),
            'totalBooking' => \App\Models\Booking::count(),
        ]);
    })->name('dashboard');

    Route::resource('users', UserController::class)->except('show');
    Route::resource('pelanggan', PelangganController::class)->except('show');
    Route::resource('booking', BookingController::class)->except('show');
});