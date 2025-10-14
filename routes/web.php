<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return view('app');
});
// Dashboard sesuai role
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/pages/guru', function () {
        return view('pages.guru');
    })->name('pages.guru');

    Route::get('/dashboard/pembina', function () {
        return view('pages.pembina');
    })->name('pages.pembina');

    Route::get('/pages/siswa', function () {
        return view('pages.siswa');
    })->name('pages.siswa');
});



Route::get('/guru', function () {
    return view('pages.guru', ['title' => 'Dashboard Guru']);
})->name('guru');
    
Route::get('/pembina', function() {
    return view('pages.pembina', ['title' => 'Dashboard Pembina']);
})->name('pembina');

Route::get('/orangtua', function() {
    return view('pages.ortusiswa', ['title' => 'Dashboard Orang Tua']);
})->name('orangtua');
