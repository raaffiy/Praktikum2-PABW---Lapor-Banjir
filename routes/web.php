<?php

use App\Http\Controllers\LaporBanjirController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Pelaporan Banjir (LaporBanjir)
| BPBD Kabupaten Bandung
|--------------------------------------------------------------------------
*/

// Halaman Form Pelaporan Banjir
Route::get('/', [LaporBanjirController::class, 'index'])->name('lapor.index');
Route::get('/lapor', [LaporBanjirController::class, 'index']);

// Pemrosesan Data Laporan (Method POST) & Tampilan Konfirmasi Laporan
Route::post('/lapor', [LaporBanjirController::class, 'submit'])->name('lapor.submit');
