<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\SiswaEkskulModel;
use Illuminate\Support\Facades\DB;

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

        // Ambil data ekstrakurikuler yang diikuti siswa
        $siswaEkskulModel = SiswaEkskulModel::with('ekstrakurikuler')
            ->where('siswa_id', $siswa->id)
            ->get();

        // Mapel → Potensi
        $potensiMapel = [
            'PRAKARYA' => 'Kreativitas',
            'PAIBP' => 'Spiritual',
            'MTK' => 'Analisis',
            'BINDO' => 'Komunikasi',
            'PPKN' => 'Kritis',
            'PJOK' => 'Kesehatan',
            'SENI BUDAYA' => 'Keterampilan',
        ];

        // Ambil nilai UAS siswa
        $nilaiUas = DB::table('nilai')
            ->select('mapel', 'nilai', 'jenis_nilai','catatan')
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
                'siswaEkskulModel' => $siswaEkskulModel
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
            'user' => $user,
            'siswa' => $siswa,
            'nilai' => $nilai,
            'siswaEkskulModel' => $siswaEkskulModel,
            'nilaiUas' => $nilaiUas,
            'rataRata' => $rataRata,
            'potensi' => $potensi,
            'labels' => $labels,
            'nilaiRadar' => $nilaiRadar,
        ]);
    }
}
