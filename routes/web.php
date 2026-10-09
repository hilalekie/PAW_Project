<?php
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KetersediaanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// halaman publik (tanpa login)
Route::get('/ketersediaan', [KetersediaanController::class, 'index'])->name('ketersediaan');
Route::post('/ketersediaan', [KetersediaanController::class, 'store'])->name('ketersediaan.store');

// halaman admin (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::resource('users', UserController::class)->except('show');
    Route::resource('ruangan', RuanganController::class)->except('show');
    Route::resource('booking', BookingController::class)->except('show');
});