<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterOtpController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BpjsKetenagakerjaanController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 Halaman Welcome (public)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 🔹 Grup rute untuk user yang BELUM login
Route::middleware('guest')->group(function () {
    // Register + OTP
    Route::get('/register', [RegisterOtpController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterOtpController::class, 'register']);

    // OTP Verification
    Route::get('/otp-verification', [OtpVerificationController::class, 'showVerificationForm'])->name('verification.otp.form');
    Route::post('/otp-verification', [OtpVerificationController::class, 'verify'])->name('verification.otp.verify');

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// 🔹 Grup rute untuk user yang SUDAH login
Route::middleware(['auth', 'verified'])->group(function () {
    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/keluar', function () {
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('welcome');
    })->name('keluar');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute-rute Excel Management untuk user biasa (jika ada)
    Route::post('/excel/update', [DashboardController::class, 'update'])->name('excel.update');
    Route::get('/excel/debug-headers', [DashboardController::class, 'debugHeaders'])->name('excel.debug');
    Route::post('/excel/store', [DashboardController::class, 'store'])->name('excel.store');
    Route::post('/excel/delete', [DashboardController::class, 'delete'])->name('excel.delete');

    // Halaman Tentang
    Route::get('/tentang', fn () => view('tentang'))->name('tentang');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Rute-rute Penugasan untuk user biasa
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
    Route::post('/penugasan', [PenugasanController::class, 'store'])->name('penugasan.store');
    Route::get('/get-kecamatan/{kabupaten_id}', [PenugasanController::class, 'getKecamatan']);
    Route::get('/penugasan/create', [PenugasanController::class, 'create'])->name('penugasan.create');
    Route::get('/penugasan/{penugasan}/edit', [PenugasanController::class, 'edit'])->name('penugasan.edit');
    Route::put('/penugasan/{penugasan}', [PenugasanController::class, 'update'])->name('penugasan.update');
    Route::delete('/penugasan/{penugasan}', [PenugasanController::class, 'destroy'])->name('penugasan.destroy');

    // Rute-rute BPJS untuk user biasa
    Route::get('/bpjs-ketenagakerjaan', [BpjsKetenagakerjaanController::class, 'index'])->name('bpjs.ketenagakerjaan');
    Route::post('/bpjs-ketenagakerjaan', [BpjsKetenagakerjaanController::class, 'store'])->name('bpjs.ketenagakerjaan.store');
    Route::delete('/bpjs-ketenagakerjaan/{photo}', [BpjsKetenagakerjaanController::class, 'destroy'])->name('bpjs.ketenagakerjaan.destroy');
    Route::get('/user/bpjs-ketenagakerjaan', [BpjsKetenagakerjaanController::class, 'showUserGallery'])->name('bpjs.ketenagakerjaan.user');
});

// 🔹 Grup rute khusus untuk ADMIN (role: admin)
// Rute ini hanya bisa diakses oleh user yang sudah login DAN memiliki role 'admin'.
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Rute Excel Management yang hanya bisa diakses admin
    Route::post('/excel/update', [AdminController::class, 'update'])->name('admin.excel.update');
    Route::get('/excel/debug-headers', [AdminController::class, 'debugHeaders'])->name('admin.excel.debug');
    Route::post('/excel/store', [AdminController::class, 'store'])->name('admin.excel.store');
    Route::post('/excel/delete', [AdminController::class, 'delete'])->name('admin.excel.delete');
});

