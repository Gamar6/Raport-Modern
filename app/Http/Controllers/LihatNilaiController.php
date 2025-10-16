<?php

// namespace App\Http\Controllers;
// use App\Models\Nilai;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class LihatNilaiController extends Controller
// {
//     public function index()
//     {
//         auth()->role(); // Pastikan user sudah login
//         $semuaNilai = Nilai::with(['siswa', 'guru.user'])->get(); 
//         return view('nilai.index', compact('semuaNilai'));
//     }
// }  

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LihatNilaiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Asumsi user punya relasi 'guru' dan guru punya atribut 'mapel' (mata pelajaran)
        $mapelGuru = $user->guru->mapel ?? null;

        if ($mapelGuru) {
            $nilai = Nilai::with(['siswa', 'guru.user'])
                ->where('mapel', $mapelGuru)
                ->get();
        } else {
            // Kalau bukan guru atau mapel gak ada, bisa tampilkan kosong atau semua
            $nilai = collect(); // kosong
        }

        return view('nilai.index', ['semuaNilai' => $nilai]);
    }
}

