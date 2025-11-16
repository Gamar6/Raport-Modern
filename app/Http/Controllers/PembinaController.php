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

    // Ambil anggota ekskul
    $anggota = SiswaEkskul::with(['siswa', 'penilaianEkskul'])
        ->where('ekskul_id', $ekskul->id)
        ->get();

    $totalAnggota = $anggota->count();

    // Rata-rata partisipasi
    $rataPartisipasi = PenilaianEkskul::whereIn(
        'siswa_ekskul_id',
        $anggota->pluck('id')
    )->avg('tingkat_partisipasi');

    // Chart partisipasi
    $chartLabels = $anggota->map(fn($a) => $a->siswa->namaSiswa);
    $chartPartisipasi = $anggota->map(fn($a) => optional($a->penilaianEkskul)->tingkat_partisipasi ?? 0);

    // Top 5 partisipasi
    $top5 = $anggota->sortByDesc(fn($a) => optional($a->penilaianEkskul)->tingkat_partisipasi ?? 0)->take(5);

    // Siswa butuh perhatian (<60%)
    $butuhPerhatian = $anggota->filter(fn($a) => (optional($a->penilaianEkskul)->tingkat_partisipasi ?? 0) < 60);

    // Distribusi keterampilan
    $keterampilanCount = $anggota->groupBy(fn($a) => optional($a->penilaianEkskul)->tingkat_keterampilan ?? 'Belum Dinilai')
                                ->map->count();

    // **Tambahkan listSiswa seperti di chartKeterampilan**
    $tingkatOptions = ['Mahir', 'Lanjut', 'Menengah', 'Pemula'];
    $dataChart =[];
    $listSiswa = [];

    foreach ($tingkatOptions as $tingkat) {
        $listSiswa[$tingkat] = $anggota->filter(fn($a) => optional($a->penilaianEkskul)->tingkat_keterampilan === $tingkat)
                                        ->map(fn($a) => $a->siswa->namaSiswa)
                                        ->toArray();
    }

    // Tambahkan kategori "Belum Dinilai"
    $listSiswa['Belum Dinilai'] = $anggota->filter(fn($a) => optional($a->penilaianEkskul)->tingkat_keterampilan === null)
                                           ->map(fn($a) => $a->siswa->namaSiswa)
                                           ->toArray();

    return view('pages.pembina', [
        'namaEkskul' => $ekskul->nama,
        'anggota' => $anggota,
        'totalAnggota' => $totalAnggota,
        'rataPartisipasi' => round($rataPartisipasi ?? 0, 2),
        'ekskul' => $ekskul,
        'namaPembina' => $pembina->nama,

        // Chart
        'chartLabels' => $chartLabels,
        'chartPartisipasi' => $chartPartisipasi,
        'top5' => $top5,
        'butuhPerhatian' => $butuhPerhatian,
        'keterampilanCount' => $keterampilanCount,
        'dataChart' => $dataChart,
        'listSiswa' => $listSiswa // **variable tambahan**
    ]);
}


    public function chartKeterampilan()
    {
        $ekskulId = Auth::user()->pembina->ekskul->id;

        // Ambil semua anggota ekskul
        $anggotaEkskul = SiswaEkskul::with('siswa')
            ->where('ekskul_id', $ekskulId)
            ->get();

        // Ambil penilaian mereka
        $penilaian = PenilaianEkskul::whereIn('siswa_ekskul_id', $anggotaEkskul->pluck('id'))->get();

        $tingkatOptions = ['Mahir', 'Lanjut', 'Menengah', 'Pemula'];

        $dataChart = [];
        $listSiswa = [];

        foreach ($tingkatOptions as $tingkat) {
            $siswaTingkat = $penilaian->filter(fn($p) => $p->tingkat_keterampilan === $tingkat)
                ->map(fn($p) => $p->anggota->siswa->namaSiswa)
                ->toArray();

            $dataChart[$tingkat] = count($siswaTingkat);
            $listSiswa[$tingkat] = $siswaTingkat;
        }

        // Tambahkan kategori "Belum Dinilai"
        $sudahDinilaiIds = $penilaian->pluck('siswa_ekskul_id')->toArray();
        $belumDinilai = $anggotaEkskul->filter(fn($a) => !in_array($a->id, $sudahDinilaiIds))
            ->map(fn($a) => $a->siswa->namaSiswa)
            ->toArray();

        $dataChart['Belum Dinilai'] = count($belumDinilai);
        $listSiswa['Belum Dinilai'] = $belumDinilai;

        return view('pages.pembina_keterampilan', [
            'dataChart' => $dataChart,
            'listSiswa' => $listSiswa
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
