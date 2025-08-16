<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\RegisterOtpController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Rute utama aplikasi
Route::get('/', function () {
    return view('welcome');
});

// Grup Rute yang hanya bisa diakses oleh pengguna yang belum terautentikasi (guest)
Route::middleware('guest')->group(function () {
    // Rute untuk pendaftaran (register) menggunakan OtpController
    // Ini adalah rute pendaftaran utama yang Anda inginkan
    Route::get('/register', [RegisterOtpController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterOtpController::class, 'register']);

    // Halaman verifikasi OTP
    Route::get('/otp/verify', [RegisterOtpController::class, 'showOtpVerificationForm'])->name('otp.show');
    Route::post('/otp/verify', [RegisterOtpController::class, 'verifyOtp'])->name('otp.verify');

    // Halaman login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    // ... tambahkan route post untuk login sesuai kebutuhan Anda
});

// Rute untuk logout
Route::get('/keluar', function () {
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('keluar');

// Grup Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute Dashboard, hanya bisa diakses setelah user terverifikasi
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    // Rute lain yang memerlukan autentikasi
    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');

    // Rute untuk halaman profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Rute untuk penugasan
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
    Route::post('/penugasan', [PenugasanController::class, 'store'])->name('penugasan.store');
    Route::get('/get-kecamatan/{kabupaten_id}', [PenugasanController::class, 'getKecamatan']);
    
    // Rute penugasan khusus untuk admin
    Route::get('/penugasan/create', [PenugasanController::class, 'create'])->name('penugasan.create');
    Route::get('/penugasan/{penugasan}/edit', [PenugasanController::class, 'edit'])->name('penugasan.edit');
    Route::put('/penugasan/{penugasan}', [PenugasanController::class, 'update'])->name('penugasan.update');
    Route::delete('/penugasan/{penugasan}', [PenugasanController::class, 'destroy'])->name('penugasan.destroy');
});

// Hapus baris ini untuk menghindari duplikasi rute pendaftaran
require __DIR__.'/auth.php';
