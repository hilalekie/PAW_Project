<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
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
});