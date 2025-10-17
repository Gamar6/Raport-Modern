<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EkskulModel;
use Illuminate\Support\Facades\Auth;
use App\Models\SiswaEkskulModel;
use App\Models\PenilaianAktivitas;
use App\Models\PenilaianPotensi;

class PembinaController extends Controller
{
    // Menampilkan dashboard pembina
public function index()
{
    $pembina = Auth::user();

    // Ambil ekskul pertama yang dibina pembina
    $ekskulDipilih = EkskulModel::where('pembina_id', $pembina->id)
        ->with('siswaEkstrakurikuler.siswa')
        ->first();

    if (!$ekskulDipilih) {
        return view('pages.pembina', [
            'ekskulDipilih' => null,
            'anggota' => collect(),
            'totalAnggota' => 0,
            'rataPartisipasi' => 0,
        ]);
    }

    $anggota = $ekskulDipilih->siswaEkstrakurikuler;
    $rataPartisipasi = PenilaianAktivitas::where('ekskul_id', $ekskulDipilih->id)->avg('partisipasi') ?? 0;

    return view('pages.pembina', [
        'ekskulDipilih' => $ekskulDipilih,
        'anggota' => $anggota,
        'totalAnggota' => $anggota->count(),
        'rataPartisipasi' => $rataPartisipasi,
    ]);
}

    // Menyimpan penilaian potensi siswa
    public function simpanPotensi(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'ekskul_id' => 'required|exists:ekskuls,id',
            'kategori_potensi' => 'required|string',
            'alasan' => 'nullable|string',
            'rekomendasi' => 'nullable|string'
        ]);

        PenilaianPotensi::create([
            'siswa_id' => $validated['siswa_id'],
            'ekskul_id' => $validated['ekskul_id'],
            'kategori_potensi' => $validated['kategori_potensi'],
            'alasan' => $validated['alasan'],
            'rekomendasi' => $validated['rekomendasi'],
            'pembina_id' => Auth::id(),
        ]);

        return back()->with('success', 'Penilaian potensi berhasil disimpan!');
    }
}
