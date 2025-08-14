<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/dashboard', [ExcelController::class, 'index'])->name('dashboard');
// Rute untuk halaman utama (login/register)
// Ketika user belum login, mereka akan melihat halaman welcome
Route::get('/', function () {
    return view('welcome');
});
Route::get('/keluar', function () {

    session()->invalidate();       // Hapus session lama
    session()->regenerateToken();  // Buat CSRF token baru
    return view('/welcome');
})->name('keluar');
// Grup rute yang hanya bisa diakses oleh user yang sudah login
Route::middleware('auth')->group(function () {
    // Rute untuk dashboard
    // Ini akan menampilkan tampilan dashboard dengan data penugasan
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    // Rute untuk profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk semua user yang sudah login (termasuk admin)
    // Tampilan daftar penugasan untuk user
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
    Route::post('/penugasan', [PenugasanController::class, 'store'])->name('penugasan.store');
    Route::get('/get-kecamatan/{kabupaten_id}', [PenugasanController::class, 'getKecamatan']);

    // Grup rute khusus untuk role 'admin'
 
        Route::get('/penugasan/create', [PenugasanController::class, 'create'])->name('penugasan.create');
        Route::get('/penugasan/{penugasan}/edit', [PenugasanController::class, 'edit'])->name('penugasan.edit');
        Route::put('/penugasan/{penugasan}', [PenugasanController::class, 'update'])->name('penugasan.update');
        Route::delete('/penugasan/{penugasan}', [PenugasanController::class, 'destroy'])->name('penugasan.destroy');
    
});

require __DIR__.'/auth.php';
