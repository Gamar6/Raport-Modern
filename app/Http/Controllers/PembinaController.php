<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembina;
use App\Models\SiswaEkskul;
use App\Models\PenilaianEkskul;
use App\Models\CatatanPembina;

class PembinaController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'pembina') {
            return redirect()->route('login')->with('error', 'Akses khusus Pembina Ekstrakurikuler.');
        }

        $pembina = Auth::user()->pembina;
        $ekskul = $pembina->ekskul;

        // ambil anggota ekskul
        $anggota = SiswaEkskul::with('siswa')
            ->where('ekskul_id', $ekskul->id)
            ->get();

        $totalAnggota = SiswaEkskul::where('ekskul_id', $ekskul->id)->count();

        // rata-rata partisipasi
        $rataPartisipasi = PenilaianEkskul::whereIn(
            'siswa_ekskul_id',
            $anggota->pluck('id')
        )->avg('tingkat_partisipasi');

        return view('pages.pembina', [
            'namaEkskul' => $ekskul->nama,
            'anggota' => $anggota,
            'totalAnggota' => $totalAnggota,
            'rataPartisipasi' => round($rataPartisipasi ?? 0, 2),
            'ekskul' => $ekskul, // ✅ kirim ekskul ke view
        ]);
    }


    public function storePenilaian(Request $request)
    {
        $request->validate([
            'ekskul_id' => 'required|exists:ekskul,id',
            'siswa_id' => 'required|exists:siswa,id',
            'tingkat_partisipasi' => 'required|integer|min:0|max:100',
            'tingkat_keterampilan' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        // Ambil SiswaEkskul sesuai siswa dan ekskul
        $siswaEkskul = SiswaEkskul::where('siswa_id', $request->siswa_id)
                                ->where('ekskul_id', $request->ekskul_id)
                                ->firstOrFail();

        // Simpan penilaian
        PenilaianEkskul::create([
            'siswa_ekskul_id' => $siswaEkskul->id,
            'tingkat_partisipasi' => $request->tingkat_partisipasi,
            'tingkat_keterampilan' => $request->tingkat_keterampilan,
            'catatan' => $request->catatan,
        ]);

        return back()->with('success', 'Penilaian berhasil disimpan.');
    }


public function storeCatatan(Request $request)
{
    $request->validate([
        'siswa_id' => 'required|exists:siswa,id',
        'ekskul_id' => 'required|exists:ekskul,id',
        'potensi' => 'nullable|string|max:255',
        'catatan' => 'nullable|string',
        'rekomendasi' => 'nullable|string'
    ]);

    $pembina = Auth::user()->pembina;

    // Pastikan siswa itu memang anggota ekskul pembina
    $siswaEkskul = SiswaEkskul::where('siswa_id', $request->siswa_id)
        ->where('ekskul_id', $request->ekskul_id)
        ->firstOrFail();

    $siswa = $siswaEkskul->siswa;

    CatatanPembina::create([
        'siswa_id' => $siswa->id,
        'pembina_id' => $pembina->id,
        'namaAnggota' => $siswa->namaSiswa,
        'catatan' => $request->catatan,
        'potensi' => $request->potensi,
        'rekomendasi_pengembangan' => $request->rekomendasi,
 
    ]);

    return back()->with('SUKSES', 'Catatan pembina berhasil disimpan.');
}



}
