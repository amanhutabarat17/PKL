<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use Maatwebsite\Excel\Facades\Excel;

// Rute untuk halaman utama (login/register)
Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

        
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk penugasan
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
    Route::post('/penugasan', [PenugasanController::class, 'store'])->name('penugasan.store');
    Route::get('/get-kecamatan/{kabupaten_id}', [PenugasanController::class, 'getKecamatan']);

    // Rute admin untuk penugasan
    Route::get('/penugasan/create', [PenugasanController::class, 'create'])->name('penugasan.create');
    Route::get('/penugasan/{penugasan}/edit', [PenugasanController::class, 'edit'])->name('penugasan.edit');
    Route::put('/penugasan/{penugasan}', [PenugasanController::class, 'update'])->name('penugasan.update');
    Route::delete('/penugasan/{penugasan}', [PenugasanController::class, 'destroy'])->name('penugasan.destroy');
});

require __DIR__.'/auth.php';