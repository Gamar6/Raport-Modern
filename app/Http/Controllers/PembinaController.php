<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembina;
use App\Models\Kelas; // Pastikan model Kelas di-import
use App\Models\Siswa;
use App\Models\SiswaEkskul;
use App\Models\PenilaianEkskul;
use App\Models\CatatanPembina;

class PembinaController extends Controller
{
    // ========================================================================
    // 1. DASHBOARD PEMBINA
    // ========================================================================
    public function index()
    {
        // 1. Cek Hak Akses
        if (!Auth::check() || Auth::user()->role !== 'pembina') {
            return redirect()->route('login')->with('error', 'Akses khusus Pembina Ekstrakurikuler.');
        }

        $pembina = Auth::user()->pembina;
        
        // 2. Cek apakah user ini sudah jadi pembina ekskul
        if (!$pembina || !$pembina->ekskul) {
            return redirect()->back()->with('error', 'Anda belum ditugaskan ke ekskul manapun. Hubungi Admin.');
        }

        $ekskul = $pembina->ekskul;

        // 3. Ambil Anggota Ekskul
        $anggota = SiswaEkskul::with(['siswa', 'penilaianEkskul'])
            ->where('ekskul_id', $ekskul->id)
            ->get();

        $totalAnggota = $anggota->count();

        // 4. Hitung Rata-rata Partisipasi
        $rataPartisipasi = PenilaianEkskul::whereIn(
            'siswa_ekskul_id',
            $anggota->pluck('id')
        )->avg('tingkat_partisipasi');

        // 5. Data untuk Chart
        $chartLabels = $anggota->map(fn($a) => $a->siswa->namaSiswa);
        $chartPartisipasi = $anggota->map(fn($a) => optional($a->penilaianEkskul)->tingkat_partisipasi ?? 0);

        // 6. Statistik Tambahan (Top 5 & Butuh Perhatian)
        $top5 = $anggota->sortByDesc(fn($a) => optional($a->penilaianEkskul)->tingkat_partisipasi ?? 0)->take(5);
        $butuhPerhatian = $anggota->filter(fn($a) => (optional($a->penilaianEkskul)->tingkat_partisipasi ?? 0) < 60);

        // 7. Distribusi Keterampilan (Chart Keterampilan)
        $keterampilanCount = $anggota->groupBy(fn($a) => optional($a->penilaianEkskul)->tingkat_keterampilan ?? 'Belum Dinilai')
                                     ->map->count();

        $tingkatOptions = ['Mahir', 'Lanjut', 'Menengah', 'Pemula'];
        $dataChart = [];
        $listSiswa = [];

        foreach ($tingkatOptions as $tingkat) {
            $listSiswa[$tingkat] = $anggota->filter(fn($a) => optional($a->penilaianEkskul)->tingkat_keterampilan === $tingkat)
                                           ->map(fn($a) => $a->siswa->namaSiswa)
                                           ->toArray();
        }
        
        $listSiswa['Belum Dinilai'] = $anggota->filter(fn($a) => optional($a->penilaianEkskul)->tingkat_keterampilan === null)
                                              ->map(fn($a) => $a->siswa->namaSiswa)
                                              ->toArray();
        
        // 8. [PENTING] Ambil Daftar Kelas untuk Dropdown "Tambah Anggota"
        $daftarKelas = Kelas::orderBy('namaKelas', 'asc')->get();

        return view('Pages.pembina', [
            // Info Dasar
            'namaEkskul' => $ekskul->nama,
            'anggota' => $anggota,
            'totalAnggota' => $totalAnggota,
            'rataPartisipasi' => round($rataPartisipasi ?? 0, 2),
            'ekskul' => $ekskul,
            'namaPembina' => $pembina->nama,
            
            // Statistik
            'chartLabels' => $chartLabels,
            'chartPartisipasi' => $chartPartisipasi,
            'top5' => $top5,
            'butuhPerhatian' => $butuhPerhatian,
            'keterampilanCount' => $keterampilanCount,
            'dataChart' => $dataChart,
            'listSiswa' => $listSiswa,

            // Data untuk Fitur Tambah Anggota
            'daftarKelas' => $daftarKelas 
        ]);
    }

    // ========================================================================
    // 2. API & STORE (FITUR TAMBAH ANGGOTA)
    // ========================================================================

    // API: Ambil Siswa berdasarkan Kelas (Dipanggil via AJAX/Alpine.js)
    public function getSiswaByKelas($kelas_id)
    {
        $siswas = Siswa::where('kelas_id', $kelas_id)
                       ->orderBy('namaSiswa', 'asc')
                       ->get(['id', 'namaSiswa']);
                       
        return response()->json($siswas);
    }

    // STORE: Simpan Anggota Baru ke Ekskul
    public function storeAnggota(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
        ]);

        $pembina = Auth::user()->pembina;
        
        if (!$pembina || !$pembina->ekskul) {
             return back()->with('error', 'Anda tidak memiliki akses ke ekskul.');
        }
        
        $ekskulId = $pembina->ekskul->id;

        // Cek Duplikasi (Apakah siswa sudah ada di ekskul ini?)
        $exists = SiswaEkskul::where('siswa_id', $request->siswa_id)
                             ->where('ekskul_id', $ekskulId)
                             ->exists();

        if ($exists) {
            return back()->with('error', 'Siswa tersebut sudah terdaftar di ekskul ini.');
        }

        // Simpan Data
        SiswaEkskul::create([
            'siswa_id'  => $request->siswa_id,
            'ekskul_id' => $ekskulId
        ]);

        return back()->with('success', 'Anggota baru berhasil ditambahkan!');
    }

    // ========================================================================
    // 3. PENILAIAN & CATATAN
    // ========================================================================

    public function storePenilaian(Request $request)
    {
        $request->validate([
            'ekskul_id' => 'required|exists:ekskul,id',
            'siswa_id' => 'required|exists:siswa,id',
            'tingkat_partisipasi' => 'required|integer|min:0|max:100',
            'tingkat_keterampilan' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        // Cari ID di tabel pivot
        $siswaEkskul = SiswaEkskul::where('siswa_id', $request->siswa_id)
                                ->where('ekskul_id', $request->ekskul_id)
                                ->firstOrFail();

        // Simpan Penilaian
        PenilaianEkskul::updateOrCreate(
            ['siswa_ekskul_id' => $siswaEkskul->id],
            [
                'tingkat_partisipasi' => $request->tingkat_partisipasi,
                'tingkat_keterampilan' => $request->tingkat_keterampilan,
                'catatan' => $request->catatan,
            ]
        );

        return back()->with('success', 'Penilaian berhasil disimpan.');
    }

    public function storeCatatan(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'ekskul_id' => 'required|exists:ekskul,id',
            'potensi' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
            'alasan' => 'nullable|string',
            'rekomendasi' => 'nullable|string'
        ]);

        $pembina = Auth::user()->pembina;
        
        // Validasi Keanggotaan
        $siswaEkskul = SiswaEkskul::where('siswa_id', $request->siswa_id)
            ->where('ekskul_id', $request->ekskul_id)
            ->firstOrFail();

        $siswa = $siswaEkskul->siswa;

        // Simpan Catatan
        CatatanPembina::create([
            'siswa_id' => $siswa->id,
            'pembina_id' => $pembina->id,
            'namaAnggota' => $siswa->namaSiswa,
            'catatan' => $request->catatan,
            'potensi' => $request->potensi,
            'alasan' => $request->alasan,
            'rekomendasi_pengembangan' => $request->rekomendasi,
        ]);

        return back()->with('SUKSES', 'Catatan potensi berhasil disimpan.');
    }
}
