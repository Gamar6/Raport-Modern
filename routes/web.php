<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PotensiController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [PotensiController::class, 'index']);
Route::get('/analisis/{id}', action: [PotensiController::class, 'analisis'])->name('analisis');
