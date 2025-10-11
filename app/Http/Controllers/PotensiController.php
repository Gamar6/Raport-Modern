<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class PotensiController extends Controller
{
    public function index()
{
    $siswas = Siswa::all();
    return view('potensi.index', compact('siswas'));
}

public function analisis($id)
{
    $siswa = Siswa::findOrFail($id);
    $nilai = $siswa->nilaiSiswa;

    // ambil top 5 mapel
    $topMapel = $nilai->sortByDesc('nilai')->take(5);

    // mapping potensi
    $mapelPotensi = [
        'Matematika' => ['Analisis Data', 'Pemecahan Masalah'],
        'IPA' => ['Observasi', 'Eksperimen'],
        'PAI' => ['Nilai Spiritual'],
        'IPS' => ['Sosial'],
        'Bahasa Indonesia' => ['Literasi'],
        'Bahasa Inggris' => ['Komunikasi'],
    ];

    $potensiData = [];
    foreach ($topMapel as $item) {
        $potensi = $mapelPotensi[$item->mapel] ?? ['Umum'];
        foreach ($potensi as $p) {
            $potensiData[$p] = $item->nilai;
        }
    }

    return view('potensi.hasil', compact('siswa', 'topMapel', 'potensiData'));
}

}
