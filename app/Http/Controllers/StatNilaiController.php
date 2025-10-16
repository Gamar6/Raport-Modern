<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatNilaiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $siswa = $user->siswa;

        if (!$siswa) {
            return redirect()->back()->with('error', 'Akun ini tidak memiliki data siswa.');
        }

        // Mapel → Potensi
        $potensiMapel = [
            'Matematika' => 'Analisis',
            'IPA' => 'Logika',
            'Bahasa Indonesia' => 'Komunikasi',
            'Bahasa Inggris' => 'Bahasa',
            'Sejarah' => 'Kritis',
            'Seni' => 'Kreativitas',
        ];

        // Ambil nilai UAS siswa
        $nilaiUas = DB::table('nilai')
            ->select('mapel', 'nilai', 'jenis_nilai')
            ->where('siswa_id', $siswa->id)
            ->whereRaw("LOWER(jenis_nilai) = 'uas'")
            ->get();

        // Kalau belum ada data
        if ($nilaiUas->isEmpty()) {
            return view('pages.siswa', [
                'siswa' => $siswa,
                'nilaiUas' => [],
                'rataRata' => 0,
                'potensi' => collect(),
                'labels' => [],
                'nilaiRadar' => [],
            ]);
        }

        // Hitung rata-rata UAS
        $rataRata = round($nilaiUas->avg('nilai'), 2);

        // Mapel + Potensi
        $nilaiArray = $nilaiUas->map(function ($item) use ($potensiMapel) {
            return (object)[
                'mapel' => $item->mapel,
                'nilai' => round($item->nilai, 2),
                'potensi' => $potensiMapel[$item->mapel] ?? $item->mapel,
            ];
        });

        // Ambil top 5 nilai tertinggi (untuk badge Potensi)
        $potensi = $nilaiArray->sortByDesc('nilai')->take(5);

        // Radar Chart — semua potensi yang ada
        $stats = [];
        foreach ($potensiMapel as $mapel => $potensiNama) {
            $nilai = $nilaiArray->firstWhere('potensi', $potensiNama)->nilai ?? 0;
            $stats[$potensiNama] = $nilai;
        }

        $labels = array_keys($stats);
        $nilaiRadar = array_values($stats);

        return view('pages.siswa', [
            'siswa' => $siswa,
            'nilaiUas' => $nilaiUas,
            'rataRata' => $rataRata,
            'potensi' => $potensi,
            'labels' => $labels,
            'nilaiRadar' => $nilaiRadar,
        ]);
    }
}
