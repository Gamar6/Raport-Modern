<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LihatNilaiController;
use App\Http\Controllers\StatNilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman melihat nilai (bisa diakses tanpa auth)
Route::get('/nilai', [LihatNilaiController::class, 'index'])->name('nilai.index');

// Homepage
Route::get('/', function () {
    return view('home');
});

// Semua route yang perlu auth
Route::middleware('auth')->group(function () {
    // Dashboard admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Halaman guru dan fungsi simpan nilai
    Route::prefix('guru')->group(function () {
        Route::get('/', [GuruController::class, 'index'])->name('pages.guru');
        Route::post('/simpan-nilai', [GuruController::class, 'simpanNilai'])->name('dashboard.guru.simpan-nilai');
        Route::post('/simpan-nilai-ujian', [GuruController::class, 'simpanNilaiUjian'])->name('dashboard.guru.simpan-nilai-ujian');
        Route::get('/siswa-by-kelas', [GuruController::class, 'getSiswaByKelas'])->name('guru.siswa-by-kelas');
    });

    // Halaman pembina
    Route::get('/pages/pembina', function () {
        return view('pages.pembina');
    })->name('pages.pembina');

    // Halaman siswa (dashboard siswa)

    Route::get('/pages/siswa', [StatNilaiController::class, 'index'])->name('pages.siswa');

});
