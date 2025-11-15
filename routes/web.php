<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\SiswaController;
use App\Models\Siswa;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use Illuminate\Http\Request; // ✔ BENAR



Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Halaman masing-masing role

//Halaman Admin
Route::get('/admin/admin', [AdminController::class, 'index'])
    ->name('admin.admin');

// Manajemen Pengguna Admin
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
Route::post('/admin/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');

Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');

Route::delete('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/mapel', [AdminController::class, 'mapel'])->name('admin.mapel');
Route::get('/admin/ekskul', [AdminController::class, 'ekskul'])->name('admin.ekskul');
Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');

//Route Halaman Guru
Route::get('/pages/guru', [GuruController::class, 'index'])->name('pages.guru');
// Route untuk form input nilai UTS
Route::post('/guru/uts/store', [GuruController::class, 'storeUTS'])->name('guru.uts.store');
Route::post('/guru/uas/store', [GuruController::class, 'storeUAS'])->name('guru.uas.store');


Route::get('/pages/siswa', [SiswaController::class, 'index'])->name('pages.siswa');
        
Route::get('/pages/pembina', [PembinaController::class, 'index'])
    ->name('pages.pembina');
//input siswa_ekskul
Route::post('/pembina/penilaian', [PembinaController::class, 'storePenilaian'])
     ->name('pembina.nilai.store');
//Input potensi siswa
Route::post('/pembina/catatan/store', [PembinaController::class, 'storeCatatan'])
    ->name('pembina.catatan.store');

Route::get('/tes-data', function () {
    // Ambil semua data relasi sederhana
    $siswa = DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->leftJoin('uts', 'siswa.id', '=', 'uts.siswa_id')
        ->leftJoin('uas', 'siswa.id', '=', 'uas.siswa_id')
        ->leftJoin('catatan_pembina', 'siswa.id', '=', 'catatan_pembina.siswa_id')
        ->select(
            'siswa.id',
            'users.username',
            'siswa.namaSiswa',
            'siswa.nis',
            'kelas.namaKelas',
            'uts.nilai as nilaiUTS',
            'uas.nilai as nilaiUAS',
            'catatan_pembina.catatan'
        )
        ->get();

    return view('tes-data', compact('siswa'));
});

// test siswa
Route::get('/test-siswa', function () {
    $data = DB::table('siswa')
        ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->leftJoin('ekskul', 'siswa.id', '=', 'ekskul.anggota_id')
        ->leftJoin('pembina', 'ekskul.pembina_id', '=', 'pembina.id')
        ->leftJoin('catatan_pembina', 'siswa.id', '=', 'catatan_pembina.siswa_id')
        ->select(
            'siswa.namaSiswa',
            'kelas.namaKelas',
            'ekskul.namaEkskul',
            'pembina.namaPembina',
            'catatan_pembina.tingkat_partisipasi',
            'catatan_pembina.tingkat_keterampilan',
            'catatan_pembina.catatan',
            'catatan_pembina.potensi',
            'catatan_pembina.rekomendasi_pengembangan'
        )
        ->get();

    return view('test-siswa', ['data' => $data]);
});


//tes pembina
Route::get('/test-ekskul', function () {
    $data = DB::table('ekskul')
        ->leftJoin('pembina', 'ekskul.pembina_id', '=', 'pembina.id')
        ->leftJoin('siswa', 'ekskul.anggota_id', '=', 'siswa.id')
        ->select(
            'ekskul.namaEkskul',
            'pembina.namaPembina',
            'siswa.namaSiswa as namaAnggota'
        )
        ->get();

    return view('test-ekskul', ['data' => $data]);
});