<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PembinaController;
use App\Models\Siswa;


Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Halaman masing-masing role
Route::get('/pages/admin', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return view('pages.admin');
    }
    abort(403, 'Akses ditolak.');
})->name('pages.admin');

Route::get('/pages/guru', function () {
    if (Auth::check() && Auth::user()->role === 'guru') {
        return view('pages.guru');
    }
    abort(403, 'Akses ditolak.');
})->name('pages.guru');



Route::get('/pages/siswa', function () {
    if (Auth::check() && Auth::user()->role === 'siswa') {
        // Ambil siswa yang terkait dengan user login
        $siswa = Siswa::with(['user', 'kelas', 'uas'])
                       ->where('user_id', Auth::id())
                       ->first(); // ambil satu siswa saja

        return view('pages.siswa', compact('siswa'));
    }

    abort(403, 'Akses ditolak.');
})->name('pages.siswa');


Route::get('/pages/pembina', function () {
    if (Auth::check() && Auth::user()->role === 'siswa') {
        return view('pages.siswa');
    }
    abort(403, 'Akses ditolak.');
})->name('pembina');


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