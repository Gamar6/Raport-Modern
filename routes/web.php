<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/guru', function () {
    return view('guru.index', ['title' => 'Dashboard Guru']);
})->name('guru');
    
Route::get('/pembina', function() {
    return view('pembina.index', ['title' => 'Dashboard Pembina']);
})->name('pembina');

Route::get('/orangtua', function() {
    return view('orangtua.index', ['title' => 'Dashboard Orang Tua']);
})->name('orangtua');

Route::get('/register', fn() => 'Halaman Registrasi')->name('register');
