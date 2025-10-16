<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Nilai;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        // Jika tidak ditemukan data siswa dari user
        if (!$siswa) {
            return view('pages.siswa', compact('user'))->with('error', 'Data siswa tidak ditemukan');
        }

        // Ambil nilai siswa
        $nilai = Nilai::where('siswa_id', $siswa->id)->get();

        return view('pages.siswa', compact('user', 'siswa', 'nilai'));
    }
}
