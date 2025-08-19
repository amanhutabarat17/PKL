<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Exception;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route baru untuk pengujian email
Route::get('/test-email-lagi', function () {
    try {
        Mail::raw('Ini email tes kedua dari Laravel.', function ($message) {
            $message->to('anggasianipar2@gmail.com')->subject('Tes Pengiriman Email Final');
        });
        return "Email tes berhasil dikirim!";
    } catch (Exception $e) {
        return "Gagal mengirim email: " . $e->getMessage();
    }
});
