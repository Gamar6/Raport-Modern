<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/', function () {
    return view('home');
})->name('home');

// Dashboard Guru
Route::get('/guru', function () {
    return view('pages.guru');
})->name('pages.guru');

// Dashboard Pembina
Route::get('/pembina', function () {
    return view('pages.pembina');
})->name('pages.pembina');

// Dashboard Orang Tua / Siswa
Route::get('/siswa', function () {
    return view('pages.siswa');
})->name('pages.siswa');

// Logout (sementara dummy)
Route::post('/logout', function () {
    return redirect('/')->with('status', 'Berhasil logout');
})->name('logout');
