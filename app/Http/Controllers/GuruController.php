<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Mapel;
use App\Models\Kelas;

class GuruController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $guru = $user->guru; // akses model Guru yang terkait

        $mapel = $guru->mapel;

        $kelasYangDiampu = $guru->kelasYangDiampu;
        
        $kelasIds = $kelasYangDiampu->pluck('id');

        $totalKelas = $kelasYangDiampu->count();

        $siswas = Siswa::whereIn('kelas_id', $kelasIds)->get();

        $totalSiswa = $siswas->count();

        return view('pages.guru', compact('mapel', 'kelasYangDiampu', 'totalKelas', 'totalSiswa', 'siswas'));
    }

    public function getSiswaByKelas(Request $request)
    {
        $kelasId = $request->query('kelas_id');

        $siswas = Siswa::where('kelas_id', $kelasId)
                    ->select('id', 'nama')
                    ->orderBy('nama')
                    ->get();

        return response()->json($siswas);
    }


    public function simpanNilai(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mapel' => 'required|string|max:50',
            'jenis_nilai' => 'required|string',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $guru = Auth::user()->guru;  // ambil data guru terkait user yang login

        Nilai::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $guru->id, // pakai id guru, bukan user
            'mapel' => $request->mapel,
            'jenis_nilai' => $request->jenis_nilai,
            'nilai' => $request->nilai,
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }

    public function simpanNilaiUjian(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mapel' => 'required|string|max:100',
            'jenis_nilai' => 'required|in:UTS,UAS',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        try {
            $guru = Auth::user()->guru;

            Nilai::create([
                'siswa_id' => $request->siswa_id,
                'guru_id' => $guru->id, 
                'mapel' => $request->mapel,
                'jenis_nilai' => $request->jenis_nilai,
                'nilai' => $request->nilai,
                'catatan' => $request->catatan,
                'tanggal_input' => now()->toDateString(),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan nilai ujian: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Nilai UTS/UAS berhasil disimpan!');
    }

}



