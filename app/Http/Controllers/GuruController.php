<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Uts;
use App\Models\Uas;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'guru') {
            return redirect()->route('login')->with('error', 'Akses khusus Guru.');
        }

        $guru = Auth::user()->guru;

        $mapel = $guru->mapel;
        $kelasList = $guru->kelasDiampu;
        $totalKelas = $kelasList->count();
        $nama = $guru->user->username;

        $semuaSiswa = $kelasList->flatMap(fn($kelas) => $kelas->siswas);

        $totalSiswa = $semuaSiswa->count();

        // Gabungkan nilai UTS, UAS, rata-rata, potensi, dan catatan
        $semuaSiswa = $semuaSiswa->map(function ($siswa) use ($guru) {
            $uts = Uts::where('siswa_id', $siswa->id)
                    ->where('guru_id', $guru->id)
                    ->first();
            $uas = Uas::where('siswa_id', $siswa->id)
                    ->where('guru_id', $guru->id)
                    ->first();

            $nilaiUts = $uts->nilai ?? null;
            $nilaiUas = $uas->nilai ?? null;

            $siswa->nilai_uts = $nilaiUts;
            $siswa->nilai_uas = $nilaiUas;
            $siswa->catatanutsGuru = $uts->catatan ?? $uas->catatan ?? '-';
            $siswa->catatanuasGuru = $uas->catatan ?? $uas->catatan ?? '-';
            $siswa->rataRataNilai = $nilaiUts && $nilaiUas ? round(($nilaiUts + $nilaiUas) / 2, 2) : ($nilaiUts ?? $nilaiUas ?? '-');

            if (is_numeric($siswa->rataRataNilai)) {
                if ($siswa->rataRataNilai >= 85) $siswa->potensi = 'Tinggi';
                elseif ($siswa->rataRataNilai >= 70) $siswa->potensi = 'Sedang';
                else $siswa->potensi = 'Perlu Perbaikan';
            } else $siswa->potensi = '-';

            // $siswa->kelas = $siswa->kelas->nama ?? '-';
            $siswa->kelas_nama = $siswa->kelas->namaKelas ?? '-';

            $siswa->mapel = $guru->mapel;

            return $siswa;
        });

        // Statistik rata-rata nilai per kelas
        $kelasLabels = $kelasList->pluck('namaKelas')->toArray();
        $utsRataRata = [];
        $uasRataRata = [];

        foreach ($kelasList as $kelas) {
            $siswas = $kelas->siswas;
            $utsNilai = $siswas->map(function($s) use ($guru) {
                $uts = Uts::where('siswa_id', $s->id)->where('guru_id', $guru->id)->first();
                return $uts->nilai ?? null;
            })->filter()->all();
            $uasNilai = $siswas->map(function($s) use ($guru) {
                $uas = Uas::where('siswa_id', $s->id)->where('guru_id', $guru->id)->first();
                return $uas->nilai ?? null;
            })->filter()->all();

            $utsRataRata[] = count($utsNilai) ? round(array_sum($utsNilai)/count($utsNilai), 2) : 0;
            $uasRataRata[] = count($uasNilai) ? round(array_sum($uasNilai)/count($uasNilai), 2) : 0;
        }

    // dd($kelasLabels, $utsRataRata, $uasRataRata);

        return view('pages.guru', compact(
            'mapel',
            'totalKelas',
            'totalSiswa',
            'kelasList',
            'nama',
            'semuaSiswa',
            'kelasLabels',
            'utsRataRata',
            'uasRataRata'
        ));
    }


    public function storeUTS(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'nilai'    => 'required|numeric|min:0|max:100',
            'catatan'  => 'required|string',
        ]);

        $guru = Auth::user()->guru;
        $siswa = Siswa::findOrFail($request->siswa_id);

        Uts::updateOrCreate(
            ['siswa_id' => $siswa->id, 'guru_id' => $guru->id],
            [
                'namaSiswa' => $siswa->namaSiswa,
                'mapel'     => $guru->mapel,
                'nilai'     => $request->nilai,
                'catatan'   => $request->catatan
            ]
        );

        return back()->with('success', 'Nilai UTS berhasil disimpan!');
    }

    public function storeUAS(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'nilai'    => 'required|numeric|min:0|max:100',
            'catatan'  => 'required|string',
        ]);

        $guru = Auth::user()->guru;
        $siswa = Siswa::findOrFail($request->siswa_id);

        Uas::updateOrCreate(
            ['siswa_id' => $siswa->id, 'guru_id' => $guru->id],
            [
                'namaSiswa' => $siswa->namaSiswa,
                'mapel'     => $guru->mapel,
                'nilai'     => $request->nilai,
                'catatan'   => $request->catatan
            ]
        );

        return back()->with('success', 'Nilai UAS berhasil disimpan!');
    }
}