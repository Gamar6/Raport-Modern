<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return view('home');
});
// Dashboard sesuai role
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/pages/guru', function () {
        return view('pages.guru');
    })->name('pages.guru');
    Route::post('/guru/simpan-nilai', [GuruController::class, 'simpanNilai'])->name('dashboard.guru.simpan-nilai');
    Route::post('/guru/simpan-nilai-ujian', [GuruController::class, 'simpanNilaiUjian'])->name('dashboard.guru.simpan-nilai-ujian');

    Route::get('/pages/pembina', function () {
    return view('pages.pembina');
    })->name('pages.pembina');

    Route::get('/pages/guru', [GuruController::class, 'index'])->name('pages.guru');
    Route::post('/pages/guru/nilai', [GuruController::class, 'simpanNilai'])->name('dashboard.guru.simpan-nilai');

    Route::get('/pages/siswa', function () {
        return view('pages.siswa');
    })->name('pages.siswa');
});



