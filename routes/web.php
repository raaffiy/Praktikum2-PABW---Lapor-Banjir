<?php

use App\Http\Controllers\LaporBanjirController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Pelaporan Banjir (LaporBanjir)
| BPBD Kabupaten Bandung
|--------------------------------------------------------------------------
*/

// 1. Halaman Form Pelaporan (Method GET)
Route::get('/', [LaporBanjirController::class, 'index'])->name('lapor.index');
Route::get('/lapor', [LaporBanjirController::class, 'index'])->name('lapor.form');

// 2. Pemrosesan Data Laporan (Method POST)
Route::post('/lapor', [LaporBanjirController::class, 'submit'])->name('lapor.submit');

// 3. Halaman Konfirmasi Laporan (Method GET)
Route::get('/konfirmasi', [LaporBanjirController::class, 'konfirmasi'])->name('lapor.konfirmasi');

// 4. Halaman Daftar Laporan Banjir (Method GET)
Route::get('/daftar-laporan', [LaporBanjirController::class, 'daftar'])->name('lapor.daftar');
