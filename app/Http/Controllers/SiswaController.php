<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use App\Models\SiswaEkskul;
use App\Models\PenilaianEkskul;

use function PHPSTORM_META\map;

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

        $ekskuls = $siswa->SiswaEkskul()
            ->with(['ekskul', 'penilaian'])
            ->get()
            ->map(function ($item) {

                $penilaian = $item->penilaian->sortByDesc('id')->first();

                return [
                    'nama' => $item->ekskul->nama ?? 'Tidak diketahui',
                    'tingkat_keterampilan' => $penilaian->tingkat_keterampilan ?? '-',
                    'tingkat_partisipasi'  => $penilaian->tingkat_partisipasi ?? 0,
                ];
            });

        // $catatanPembina = $siswa->catatanPembina->map(function ($catatan) {
        //     $pembina = $catatan->pembina;
        //     $userPembina = $pembina?->user;
        //     $ekskul = $pembina?->ekskul;

        //     return [
        //         'catatan' => $catatan->catatan ?? '-',
        //         'alasan' => $catatan->potensi ?? '-',
        //         'pengembangan' => $catatan->rekomendasi_pengembangan ?? '-',
        //         'pembina_nama' => $userPembina->name ?? $pembina->nama ?? 'Tidak diketahui',
        //         'pembina_ekskul' => $ekskul->nama ?? 'Tidak diketahui',
        //     ];
        // });

        $catatanPembina = $siswa->catatanPembina->map(function ($catatan) {
        $pembina = $catatan->pembina;
        $userPembina = $pembina?->user;
        $ekskul = $pembina?->ekskul;

        // ambil catatan dari penilaian_ekskul
        $penilaian = PenilaianEkskul::whereHas('anggota', function ($q) use ($ekskul, $catatan) {
            $q->where('siswa_id', $catatan->siswa_id)
            ->where('ekskul_id', $ekskul->id); // di sini benar, karena siswa_ekskul ada kolom ekskul_id
        })->first();

        return [
            'catatan' => $penilaian->catatan ?? '-',  // ganti ambil dari penilaian
            'alasan' => $catatan->potensi ?? '-',
            'pengembangan' => $catatan->rekomendasi_pengembangan ?? '-',
            'pembina_nama' => $userPembina->name ?? $pembina->nama ?? 'Tidak diketahui',
            'pembina_ekskul' => $ekskul->nama ?? 'Tidak diketahui',
        ];
    });


        // 🔹 Ambil catatan dari tabel UTS dan UAS milik siswa ini
        $catatanUTS = $siswa->uts()
            ->with('guru.user')
            ->whereNotNull('catatan')
            ->get()
            ->map(function ($item) {
                $guruNama = $item->guru?->user?->username ?? 'Guru Tidak Diketahui';

                return [
                    'mapel' => $item->mapel,
                    'catatan' => $item->catatan,
                    'guru_nama' => $guruNama,
                ];
            });

        $catatanUAS = $siswa->uas()
            ->with('guru.user')
            ->whereNotNull('catatan')
            ->get()
            ->map(function ($item) {
                $guruNama = $item->guru?->user?->username ?? 'Guru Tidak Diketahui';

                return [
                    'mapel' => $item->mapel,
                    'catatan' => $item->catatan,
                    'guru_nama' => $guruNama,
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
            'catatanPembina',
            'catatanUAS',
            'catatanUTS'
        ));
    }
}
