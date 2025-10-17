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

        if (!$siswa) {
            return view('pages.siswa', compact('user'))->with('error', 'Data siswa tidak ditemukan');
        }

        // Ambil nilai siswa
        $nilai = Nilai::where('siswa_id', $siswa->id)->get();

        // Ambil data ekstrakurikuler beserta catatan pembina yang terkait,
        // termasuk eager load pembina dari ekskul
$siswaEkskulModel = SiswaEkskulModel::with([
    'ekstrakurikuler.pembina',
    'catatanPembina.pembina'
])->where('siswa_id', $siswa->id)->get();


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

        $rataRata = round($nilaiUas->avg('nilai'), 2);

        $nilaiArray = $nilaiUas->map(function ($item) use ($potensiMapel) {
            return (object)[
                'mapel' => $item->mapel,
                'nilai' => round($item->nilai, 2),
                'potensi' => $potensiMapel[$item->mapel] ?? $item->mapel,
            ];
        });

        $potensi = $nilaiArray->sortByDesc('nilai')->take(5);

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
