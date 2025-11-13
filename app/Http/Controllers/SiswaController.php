<?php
namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data siswa yang terhubung dengan user yang sedang login
        $siswa = Siswa::with(['user', 'kelas'])
                      ->where('user_id', Auth::id()) // Pastikan ada relasi 'user_id' di tabel siswa
                      ->first(); // Ambil satu data siswa berdasarkan user yang sedang login

        // Jika siswa tidak ditemukan, bisa redirect ke halaman lain
        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Siswa tidak ditemukan.');
        }

        // Kirim data siswa ke view
        return view('pages.siswa', compact('siswa'));
    }
}
