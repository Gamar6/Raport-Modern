<?php
namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with(['user', 'kelas', 'uas'])
                    ->where('user_id', Auth::id())
                    ->first();

        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Siswa tidak ditemukan.');
        }

        $rataRataUAS = $siswa->uas ? $siswa->uas->avg('nilai') : 0;

        //Daftar potensi masing-masing mata pelajaran
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
                'potensi' => $mapelPotensi[$item->mapel] ?? ['Umum'], // sekarang array
                'nilai' => $item->nilai,
            ];
        }); 

        $uas = $siswa->uas;
        
        $potensiData = collect();
        foreach ($uas as $item) {
            $potensi = $mapelPotensi[$item->mapel][0] ?? 'Umum'; // cuma ambil potensi pertama
            $potensiData->push([
                'potensi' => $potensi,
                'nilai' => $item->nilai,
            ]);
        }

        $chartLabels = $potensiData->pluck('potensi');
        $chartData = $potensiData->pluck('nilai');



        return view('pages.siswa', compact('siswa', 'rataRataUAS', 'topPotensi', 'potensiData', 'chartLabels', 'chartData'));
    }
}
