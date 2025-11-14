<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pembina;
use App\Models\Ekskul;
use App\Models\Uts;
use App\Models\Uas;
use App\Models\CatatanPembina;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // ----------------------------
        // 1. Ringkasan Data
        // ----------------------------
        $total_siswa = Siswa::count();
        $total_guru = Guru::count();
        $total_pembina = Pembina::count();
        $total_ekskul = Ekskul::count();

        // ----------------------------
        // 2. Progress Pengisian Nilai
        // ----------------------------
        // asumsi sementara: 1 guru = 1 mapel
        $total_mapel = max(1, $total_guru);
        $total_nilai_wajib_uts = $total_siswa * $total_mapel;
        $total_nilai_wajib_uas = $total_siswa * $total_mapel;

        $nilai_uts_terisi = Uts::count();
        $nilai_uas_terisi = Uas::count();

        $progress_uts = $total_nilai_wajib_uts > 0
            ? round(($nilai_uts_terisi / $total_nilai_wajib_uts) * 100, 1)
            : 0;

        $progress_uas = $total_nilai_wajib_uas > 0
            ? round(($nilai_uas_terisi / $total_nilai_wajib_uas) * 100, 1)
            : 0;

        // Persentase yang ditampilkan di chart "Guru (%)"
        // gunakan rata-rata UTS & UAS sebagai indikasi pengisian oleh guru
        $persentase_guru = round(( $progress_uts + $progress_uas ) / 2, 1);

        // Progress Pembina: gunakan jumlah catatan pembina dibanding jumlah siswa
        $total_catatan_pembina = CatatanPembina::count();
        $persentase_pembina = $total_siswa > 0
            ? round(($total_catatan_pembina / $total_siswa) * 100, 1)
            : 0;

        // ----------------------------
        // 3. Rata-rata Nilai per Mapel
        // ----------------------------
        // kumpulkan nama mapel dari tabel UTS dan UAS
        $mapelFromUts = Uts::pluck('mapel')->filter()->unique();
        $mapelFromUas = Uas::pluck('mapel')->filter()->unique();
        $mapelNames = $mapelFromUts->merge($mapelFromUas)->unique()->values();

        $nilai_mapel = [];
        foreach ($mapelNames as $mapel) {
            $avgUts = Uts::where('mapel', $mapel)->avg('nilai');
            $avgUas = Uas::where('mapel', $mapel)->avg('nilai');

            if (!is_null($avgUts) && !is_null($avgUas)) {
                $avg = ($avgUts + $avgUas) / 2;
            } elseif (!is_null($avgUts)) {
                $avg = $avgUts;
            } elseif (!is_null($avgUas)) {
                $avg = $avgUas;
            } else {
                $avg = 0;
            }

            $nilai_mapel[$mapel] = round($avg, 2);
        }

        // jika tidak ada mapel, set default
        if (empty($nilai_mapel)) {
            $nilai_mapel = ['—' => 0];
        }

        // ----------------------------
        // 4. Perkembangan Nilai (mis. 6 bulan terakhir)
        // ----------------------------
        $months = [];
        $values = [];
        $now = Carbon::now();
        // ambil 6 bulan terakhir (termasuk bulan ini)
        for ($i = 5; $i >= 0; $i--) {
            $start = $now->copy()->startOfMonth()->subMonths($i);
            $end = $start->copy()->endOfMonth();
            $label = $start->format('M Y'); // contoh: "Nov 2025"
            $months[] = $label;

            // rata-rata nilai bulan ini dari UTS+UAS
            $avgUtsMonth = Uts::whereBetween('created_at', [$start, $end])->avg('nilai');
            $avgUasMonth = Uas::whereBetween('created_at', [$start, $end])->avg('nilai');

            if (!is_null($avgUtsMonth) && !is_null($avgUasMonth)) {
                $avgMonth = ($avgUtsMonth + $avgUasMonth) / 2;
            } elseif (!is_null($avgUtsMonth)) {
                $avgMonth = $avgUtsMonth;
            } elseif (!is_null($avgUasMonth)) {
                $avgMonth = $avgUasMonth;
            } else {
                $avgMonth = 0;
            }

            $values[] = round($avgMonth, 2);
        }

        // ----------------------------
        // 5. Rata-rata keseluruhan siswa (opsional)
        // ----------------------------
        $rata_rata_semua_siswa = Siswa::avg('rataNilai') ?? 0;

        // ----------------------------
        // Kirim ke view (variabel sesuai blade)
        // ----------------------------
        return view('admin.admin', [
            'total_siswa' => $total_siswa,
            'total_guru' => $total_guru,
            'total_pembina' => $total_pembina,
            'total_ekskul' => $total_ekskul,

            'persentase_guru' => $persentase_guru,
            'persentase_pembina' => $persentase_pembina,

            'nilai_mapel' => $nilai_mapel,

            'perkembangan_labels' => $months,
            'perkembangan_values' => $values,

            'rata_rata_semua_siswa' => round($rata_rata_semua_siswa, 2),

            // juga kirim progress UTS/UAS raw kalau perlu
            'progress_uts' => $progress_uts,
            'progress_uas' => $progress_uas,
            'progress_ekskul' => $persentase_pembina,
        ]);
    }


}
