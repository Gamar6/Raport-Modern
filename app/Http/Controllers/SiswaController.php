<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        // 🔹 Ambil data siswa beserta relasi user, kelas, uas, dan ekskul
        $siswa = Siswa::with(['user', 'kelas', 'uas', 'ekskuls','catatanPembina.pembina.ekskul'])
                    ->where('user_id', Auth::id())
                    ->first();

        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Siswa tidak ditemukan.');
        }

        // 🔹 Hitung rata-rata nilai UAS
        $rataRataUAS = $siswa->uas ? number_format($siswa->uas->avg('nilai'), 2) : '0.00';

        // 🔹 Daftar potensi berdasarkan mapel
        $mapelPotensi = [
            'Matematika' => ['Logika', 'Analisis'],
            'IPA' => ['Observasi', 'Eksperimen'],
            'Bahasa Indonesia' => ['Literasi', 'Ekspresi'],
            'IPS' => ['Sosial', 'Kolaborasi'],
            'PJOK' => ['Motorik', 'Disiplin'],
            'Seni Budaya' => ['Kreativitas', 'Estetika']
        ];

        $uas = $siswa->uas;
        $top3UAS = $uas->sortByDesc('nilai')->take(3);

        $topPotensi = $top3UAS->map(function($item) use ($mapelPotensi) {
            return [
                'mapel' => $item->mapel,
                'potensi' => $mapelPotensi[$item->mapel] ?? ['Umum'],
                'nilai' => $item->nilai,
            ];
        });

        // 🔹 Data potensi untuk chart
        $potensiData = collect();
        foreach ($uas as $item) {
            $potensi = $mapelPotensi[$item->mapel][0] ?? 'Umum';
            $potensiData->push([
                'potensi' => $potensi,
                'nilai' => $item->nilai,
            ]);
        }

        $chartLabels = $potensiData->pluck('potensi');
        $chartData = $potensiData->pluck('nilai');

        // 🔹 Ambil data ekstrakurikuler siswa (dari pivot siswa_ekskul)
        $ekskuls = $siswa->ekskuls->map(function($ekskul) {
            return [
                'nama' => $ekskul->namaEkskul,
                'tingkat_keterampilan' => $ekskul->pivot->tingkat_keterampilan,
                'tingkat_partisipasi' => $ekskul->pivot->tingkat_partisipasi,
            ];
        });

        $catatanPembina = $siswa->catatanPembina->map(function ($catatan) {
            $pembina = $catatan->pembina;
            $userPembina = $pembina?->user;
            $ekskul = $pembina?->ekskul;

            return [
                'catatan' => $catatan->catatan ?? '-',
                'alasan' => $catatan->potensi ?? '-',
                'pengembangan' => $catatan->rekomendasi_pengembangan ?? '-',
                'pembina_nama' => $userPembina->name ?? $pembina->nama ?? 'Tidak diketahui',
                'pembina_ekskul' => $ekskul->nama ?? 'Tidak diketahui',
            ];
        });

        return view('pages.siswa', compact(
            'siswa',
            'rataRataUAS',
            'topPotensi',
            'potensiData',
            'chartLabels',
            'chartData',
            'ekskuls',
            'catatanPembina' // <— tambahkan ini
        ));
    }
}
