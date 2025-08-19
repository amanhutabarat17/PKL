<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterOtpController;
use App\Http\Controllers\Auth\OtpVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Pastikan ini ada atau sesuaikan dengan controller-mu

<<<<<<< HEAD
// Rute untuk halaman utama (login/register)
=======


// Rute utama aplikasi
>>>>>>> 63c6224d1ba89df355fc8ff1c68ebdd95c0e5dde
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/keluar', function () {
    session()->invalidate();       // Hapus session lama
    session()->regenerateToken();  // Buat CSRF token baru
    return view('/welcome');
})->name('keluar');

Route::get('/atur', function () {
    return view('/pengaturan');
})->name('atur');

// Grup rute yang hanya bisa diakses oleh user yang sudah login
Route::middleware('auth')->group(function () {
    // Rute untuk dashboard
=======
// Grup Rute yang hanya bisa diakses oleh pengguna yang belum terautentikasi (guest)
Route::middleware('guest')->group(function () {
    // Rute untuk pendaftaran (register)
    Route::get('/register', [RegisterOtpController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterOtpController::class, 'register']);

    // Rute untuk verifikasi OTP
    Route::get('/otp-verification', [OtpVerificationController::class, 'showVerificationForm'])->name('verification.otp.form');
    Route::post('/otp-verification', [OtpVerificationController::class, 'verify'])->name('verification.otp.verify');

    // Halaman login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    // Tambahkan rute POST untuk memproses login
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// Rute untuk logout
Route::get('/keluar', function () {
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('keluar');
// ... (kode rute lainnya)

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');

// Grup Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute Dashboard, hanya bisa diakses setelah user terverifikasi
>>>>>>> 63c6224d1ba89df355fc8ff1c68ebdd95c0e5dde
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

<<<<<<< HEAD
        
    // Rute untuk Excel update - PENTING: ini harus di dalam middleware auth
    Route::post('/excel/update', [DashboardController::class, 'update'])
        ->name('excel.update');
    
    // Rute debug untuk melihat header Excel
    Route::get('/excel/debug-headers', [DashboardController::class, 'debugHeaders'])
        ->name('excel.debug');

        //route ke showModal
        Route::post('/excel/store', [DashboardController::class, 'store'])->name('excel.store');
Route::post('/excel/delete', [DashboardController::class, 'delete'])->name('excel.delete');
    // Rute untuk profile
=======
    // Rute lain yang memerlukan autentikasi
    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');

    // Rute untuk halaman profil
>>>>>>> 63c6224d1ba89df355fc8ff1c68ebdd95c0e5dde
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Rute untuk penugasan
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
    Route::post('/penugasan', [PenugasanController::class, 'store'])->name('penugasan.store');
    Route::get('/get-kecamatan/{kabupaten_id}', [PenugasanController::class, 'getKecamatan']);
<<<<<<< HEAD

    // Rute admin untuk penugasan
=======
    
    // Rute penugasan khusus untuk admin
>>>>>>> 63c6224d1ba89df355fc8ff1c68ebdd95c0e5dde
    Route::get('/penugasan/create', [PenugasanController::class, 'create'])->name('penugasan.create');
    Route::get('/penugasan/{penugasan}/edit', [PenugasanController::class, 'edit'])->name('penugasan.edit');
    Route::put('/penugasan/{penugasan}', [PenugasanController::class, 'update'])->name('penugasan.update');
    Route::delete('/penugasan/{penugasan}', [PenugasanController::class, 'destroy'])->name('penugasan.destroy');
});

<<<<<<< HEAD
require __DIR__.'/auth.php';
=======
// Hapus baris ini untuk menghindari duplikasi rute pendaftaran
// require __DIR__.'/auth.php';
>>>>>>> 63c6224d1ba89df355fc8ff1c68ebdd95c0e5dde
