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
    $user = auth()->user();

    if ($user->role !== 'pembina') {
        abort(403, 'Akses ditolak.');
    }

    $ekskul = EkskulModel::where('pembina_id', $user->id)->first();

    if (!$ekskul) {
        return view('pages.pembina', [
            'ekskul' => null,
            'siswaEkskul' => collect(),
            'rataPartisipasi' => 0,
            'message' => 'Anda belum memiliki ekskul binaan.'
        ]);
    }

    $siswaEkskul = SiswaEkskulModel::with('siswa')
        ->where('ekskul_id', $ekskul->id)
        ->get();

    // hitung rata-rata partisipasi (pastikan konversi ke float)
    $totalPart = $siswaEkskul->sum(fn($it) => (float) ($it->partisipasi ?? 0));
    $totalAnggota = $siswaEkskul->count();
    $rataPartisipasi = $totalAnggota ? ($totalPart / $totalAnggota) : 0;

    return view('pages.pembina', compact('ekskul', 'siswaEkskul', 'rataPartisipasi'));
}

    // Menyimpan penilaian aktivitas siswa
public function simpanAktivitas(Request $request)
{
    $request->validate([
        'siswa_id' => 'required|exists:siswa,id',
        'ekskul_id' => 'required|exists:ekskul,id',
        'partisipasi' => 'required|numeric|min:0|max:100',
        'tingkat_keterampilan' => 'required|in:pemula,menengah,lanjut,mahir',
        'catatan' => 'nullable|string',
    ]);

    PenilaianAktivitas::updateOrCreate(
        [
            'siswa_id' => $request->siswa_id,
            'ekskul_id' => $request->ekskul_id,
        ],
        [
            'partisipasi' => $request->partisipasi,
            'tingkat_keterampilan' => $request->tingkat_keterampilan,
            'catatan' => $request->catatan,
        ]
    );

    return back()->with('success', 'Penilaian aktivitas berhasil disimpan.');
}

public function simpanPotensi(Request $request)
{
    $request->validate([
        'siswa_id' => 'required|exists:siswa,id',
        'ekskul_id' => 'required|exists:ekskul,id',
        'bakat' => 'required|numeric|min:0|max:100',
        'kerjasama' => 'required|numeric|min:0|max:100',
        'disiplin' => 'required|numeric|min:0|max:100',
        'catatan' => 'nullable|string',
    ]);

    PenilaianPotensi::updateOrCreate(
        [
            'siswa_id' => $request->siswa_id,
            'ekskul_id' => $request->ekskul_id,
        ],
        [
            'bakat' => $request->bakat,
            'kerjasama' => $request->kerjasama,
            'disiplin' => $request->disiplin,
            'catatan' => $request->catatan,
        ]
    );

    return back()->with('success', 'Penilaian potensi berhasil disimpan.');
}

public function simpanPenilaian(Request $request)
{
    $ekskul = EkskulModel::where('pembina_id', $user->id)->firstOrFail();

    // Ambil array dari form
    $siswa_ids = $request->siswa_id;
    $bakat = $request->bakat;
    $kerjasama = $request->kerjasama;
    $disiplin = $request->disiplin;
    $catatan = $request->catatan;

    // Loop berdasarkan index
    for ($i = 0; $i < count($siswa_ids); $i++) {
        PenilaianPotensi::updateOrCreate(
            [
                'ekskul_id' => $ekskul->id,
                'siswa_id' => $siswa_ids[$i],
            ],
            [
                'bakat' => $bakat[$i] ?? 0,
                'kerjasama' => $kerjasama[$i] ?? 0,
                'disiplin' => $disiplin[$i] ?? 0,
                'catatan' => $catatan[$i] ?? null,
            ]
        );
    }
    
    // Update partisipasi siswa
    foreach ($request->partisipasi as $id => $partisipasi) {
        SiswaEkskulModel::where('id', $id)->update(['partisipasi' => $partisipasi]);
    }

    return back()->with('success', 'Penilaian berhasil disimpan.');
}


}
