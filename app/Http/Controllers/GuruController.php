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
        // Pastikan user login dan role adalah guru
        if (!Auth::check() || Auth::user()->role !== 'guru') {
            return redirect()->route('login')->with('error', 'Akses khusus Guru.');
        }

        // Mengambil data guru yang sedang login
        $guru = Auth::user()->guru;

        // Mengambil mata pelajaran yang diajarkan oleh guru
        $mapel = $guru->mapel;

        // Mengambil kelas yang diampu oleh guru (wali kelas)
        $kelasList = $guru->kelasDiampu;

        // Menghitung total kelas
        $totalKelas = $kelasList->count();

        $nama = $guru->user->username;

        // Menghitung total siswa yang diajar (di setiap kelas yang diampu guru)
        $totalSiswa = $kelasList->sum(function ($kelas) {
            return $kelas->siswas->count();
        });
                  
        $semuaSiswa = $kelasList->flatMap(function ($kelas) {
            return $kelas->siswas; 
        });



        // Mengirimkan data ke view
        return view('pages.guru', compact('mapel', 'totalKelas', 'totalSiswa', 'kelasList', 'nama', 'semuaSiswa'));
    }

    public function storeUTS(Request $request)
    {
        $siswa = Siswa::findOrFail($request->siswa_id);

        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'nilai'    => 'required|numeric|min:0|max:100',
            'catatan'  => 'required|string',
        ]);

        $guru = Auth::user()->guru;

        // Simpan
        $uts = Uts::create([
            'siswa_id'   => $request->siswa_id,
            'namaSiswa'  => $siswa->namaSiswa,
            'mapel'      => $guru->mapel,
            'nilai'      => $request->nilai,
            'guru_id'    => $guru->id,
            'catatan'    => $request->catatan
        ]); 
        // dd(
        //     "MASUK STORE", $request->all(),
        //     [
        //     'guru_id' => $guru->id,
        //     'mapel' => $guru->mapel
        // ]);
        return back()->with('success', 'Nilai UTS berhasil disimpan!');
    }

    public function storeUAS(Request $request)
    {
        $siswa = Siswa::findOrFail($request->siswa_id);

        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'nilai'    => 'required|numeric|min:0|max:100',
            'catatan'  => 'required|string',
        ]);

        $guru = Auth::user()->guru;

        // Simpan
        $uas = Uas::create([
            'siswa_id'   => $request->siswa_id,
            'namaSiswa'  => $siswa->namaSiswa,
            'mapel'      => $guru->mapel,
            'nilai'      => $request->nilai,
            'guru_id'    => $guru->id,
            'catatan'    => $request->catatan
        ]); 
       
        return back()->with('success', 'Nilai UTS berhasil disimpan!');
    }
    
}