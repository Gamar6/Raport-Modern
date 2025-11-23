<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Import Controller
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\SiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. HALAMAN PUBLIK & AUTH
// ==========================================

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==========================================
// 2. ROLE: ADMIN
// ==========================================
// Middleware memastikan hanya user dengan role 'admin' yang bisa akses
Route::middleware(['auth', 'user-role:admin'])->group(function () {
    
    // Dashboard Utama
    Route::get('/admin/admin', [AdminController::class, 'index'])->name('admin.admin');

    // Manajemen Pengguna (CRUD User)
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Manajemen Mata Pelajaran & Pengampu (Edit Guru)
    Route::get('/admin/mapel', [AdminController::class, 'mapel'])->name('admin.mapel');
    Route::get('/admin/mapel/{id}/edit', [AdminController::class, 'editMapel'])->name('admin.mapel.edit');
    Route::put('/admin/mapel/{id}', [AdminController::class, 'updateMapel'])->name('admin.mapel.update');

    // Manajemen Ekstrakurikuler & Pembina (Edit Ekskul)
    Route::get('/admin/ekskul', [AdminController::class, 'ekskul'])->name('admin.ekskul');
    Route::get('/admin/ekskul/{id}/edit', [AdminController::class, 'editEkskul'])->name('admin.ekskul.edit');
    Route::put('/admin/ekskul/{id}', [AdminController::class, 'updateEkskul'])->name('admin.ekskul.update');

    // Laporan
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
});

// ==========================================
// 3. ROLE: GURU
// ==========================================
Route::middleware(['auth', 'user-role:guru'])->group(function () {
    
    // Dashboard Guru
    Route::get('/pages/guru', [GuruController::class, 'index'])->name('pages.guru');
    
    // Input Nilai Akademik
    Route::post('/guru/uts/store', [GuruController::class, 'storeUTS'])->name('guru.uts.store');
    Route::post('/guru/uas/store', [GuruController::class, 'storeUAS'])->name('guru.uas.store');
});

// ==========================================
// 4. ROLE: PEMBINA
// ==========================================
Route::middleware(['auth', 'user-role:pembina'])->group(function () {
    
    // Dashboard Pembina
    Route::get('/pages/pembina', [PembinaController::class, 'index'])->name('pages.pembina');
    
    // Input Nilai Aktivitas Ekskul
    Route::post('/pembina/penilaian', [PembinaController::class, 'storePenilaian'])->name('pembina.nilai.store');
    
    // Input Catatan Potensi
    Route::post('/pembina/catatan/store', [PembinaController::class, 'storeCatatan'])->name('pembina.catatan.store');

    // Tambah Anggota Ekskul (Baru)
    Route::post('/pembina/anggota/store', [PembinaController::class, 'storeAnggota'])->name('pembina.anggota.store');

    // API Helper untuk Dropdown Siswa (AJAX)
    Route::get('/api/siswa-by-kelas/{kelas_id}', [PembinaController::class, 'getSiswaByKelas'])->name('api.siswa.by.kelas');
});

// ==========================================
// 5. ROLE: SISWA
// ==========================================
Route::middleware(['auth', 'user-role:siswa'])->group(function () {
    
    // Dashboard Siswa
    Route::get('/pages/siswa', [SiswaController::class, 'index'])->name('pages.siswa');
});

// ==========================================
// 6. DEBUGGING / TES DATA (Opsional)
// ==========================================
// Route ini bisa dihapus saat aplikasi sudah jadi (production)

Route::get('/tes-data', function () {
    $siswa = DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->leftJoin('uts', 'siswa.id', '=', 'uts.siswa_id')
        ->leftJoin('uas', 'siswa.id', '=', 'uas.siswa_id')
        ->leftJoin('catatan_pembina', 'siswa.id', '=', 'catatan_pembina.siswa_id')
        ->select(
            'siswa.id', 'users.username', 'siswa.namaSiswa', 'siswa.nis', 
            'kelas.namaKelas', 'uts.nilai as nilaiUTS', 'uas.nilai as nilaiUAS', 
            'catatan_pembina.catatan'
        )
        ->get();
    return view('tes-data', compact('siswa'));
});

Route::get('/test-siswa', function () {
    $data = DB::table('siswa')
        ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->leftJoin('siswa_ekskul', 'siswa.id', '=', 'siswa_ekskul.siswa_id')
        ->leftJoin('ekskul', 'siswa_ekskul.ekskul_id', '=', 'ekskul.id')
        ->leftJoin('pembina', 'ekskul.pembina_id', '=', 'pembina.id')
        ->leftJoin('catatan_pembina', 'siswa.id', '=', 'catatan_pembina.siswa_id')
        ->select(
            'siswa.namaSiswa', 'kelas.namaKelas', 'ekskul.nama as namaEkskul', 
            'pembina.nama as namaPembina', 'catatan_pembina.catatan'
        )
        ->get();
    return view('test-siswa', ['data' => $data]);
});

Route::get('/test-ekskul', function () {
    $data = DB::table('ekskul')
        ->leftJoin('pembina', 'ekskul.pembina_id', '=', 'pembina.id')
        ->select('ekskul.nama as namaEkskul', 'pembina.nama as namaPembina')
        ->get();
    return view('test-ekskul', ['data' => $data]);
});