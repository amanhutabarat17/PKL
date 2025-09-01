<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterOtpController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BpjsKetenagakerjaanController;
<<<<<<< Updated upstream
// Tambahkan use statement ini di bagian atas
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
=======
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
>>>>>>> Stashed changes

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 Halaman Welcome (public)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rute ini tampaknya tidak terdefinisi dengan benar, saya akan meninggalkannya
// dan menyarankan untuk mengecek kembali penggunaan dan tujuannya.
Route::post('/bpjs.ketenagakerjaanuser', [OtpVerificationController::class, 'verify']);

// 🔹 Grup rute untuk user yang BELUM login
Route::middleware('guest')->group(function () {
    // Register + OTP
    Route::get('/register', [RegisterOtpController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterOtpController::class, 'register']);

    // Rute untuk verifikasi OTP saat register
    Route::get('/otp-verification', [OtpVerificationController::class, 'showVerificationForm'])->name('verification.otp.form');
    Route::post('/otp-verification', [OtpVerificationController::class, 'verify'])->name('verification.otp.verify');

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // Rute untuk Lupa Kata Sandi berbasis tautan
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});


// 🔹 Grup rute untuk user yang SUDAH login
Route::middleware('auth')->group(function () {
    // Logout (POST)
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard (harus verified)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    // Excel Management
    Route::post('/excel/update', [DashboardController::class, 'update'])->name('excel.update');
    Route::get('/excel/debug-headers', [DashboardController::class, 'debugHeaders'])->name('excel.debug');
    Route::post('/excel/store', [DashboardController::class, 'store'])->name('excel.store');
    Route::post('/excel/delete', [DashboardController::class, 'delete'])->name('excel.delete');

    // BPJS Ketenagakerjaan
    Route::get('/bpjs-ketenagakerjaan', [BpjsKetenagakerjaanController::class, 'index'])
        ->name('bpjs.ketenagakerjaan');
    Route::post('/bpjs-ketenagakerjaan', [BpjsKetenagakerjaanController::class, 'store'])
        ->name('bpjs.ketenagakerjaan.store');
    Route::delete('/bpjs-ketenagakerjaan/{photo}', [BpjsKetenagakerjaanController::class, 'destroy'])
        ->name('bpjs.ketenagakerjaan.destroy');
    // Halaman Tentang
    Route::get('/user/bpjs-ketenagakerjaan', [BpjsKetenagakerjaanController::class, 'showUserGallery'])->name('bpjs.ketenagakerjaanuser');


    // Rute untuk user yang sudah login dan terverifikasi
    Route::middleware(['auth', 'verified'])->group(function () {

        // Grup rute dengan awalan 'user'
        Route::prefix('user')->group(function () {
            // Rute untuk dashboard user
        
            Route::get('/user/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard'); 
            Route::get('/user/dashboard', [DashboardUserController::class, 'index'])->name('dashboarduser');

            // Rute untuk daftar penugasan user
            Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasanuser');
        });

    });

    Route::get('/tentang', fn () => view('tentang'))->name('tentang');

    // Profil
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/destroy', function () {
    })->name('penugasan.destroy');
    Route::get('/keluar', function () {
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('keluar');
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
    Route::post('/penugasan', [PenugasanController::class, 'store'])->name('penugasan.store');
    Route::get('/get-kecamatan/{kabupaten_id}', [PenugasanController::class, 'getKecamatan']);


    Route::get('/penugasan/create', [PenugasanController::class, 'create'])->name('penugasan.create');
    Route::get('/penugasan/{penugasan}/edit', [PenugasanController::class, 'edit'])->name('penugasan.edit');
    Route::put('/penugasan/{penugasan}', [PenugasanController::class, 'update'])->name('penugasan.update');
    Route::delete('/penugasan/{penugasan}', [PenugasanController::class, 'destroy'])->name('penugasan.destroy');

    // 🔹 Logout via GET (opsional, jika kamu pakai tombol biasa)
    Route::get('/keluar', function () {
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('welcome');
    })->name('keluar');
});

// KODE BARU DITAMBAHKAN DI SINI
// Route ini akan menangani permintaan gambar dari storage
Route::get('/storage/photos/{filename}', function ($filename) {
    // Path file di dalam folder storage/app/public/
    $path = 'photos/' . $filename;

    // Cek apakah file ada
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    // Ambil file dari storage
    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    // Buat response untuk menampilkan file di browser
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('storage.image');
