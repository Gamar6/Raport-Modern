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
use App\Models\SiswaEkskul;
use App\Models\PenilaianEkskul;
use Carbon\Carbon;
use Illuminate\Http\Request; // ✔ BENAR


class AdminController extends Controller
{

    public function users()
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses khusus Admin.');
        }

        $users = \App\Models\User::all(); // ambil data user
        return view('admin.users', compact('users'));
    }

    public function mapel()
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses khusus Admin.');
        }

        $mapels = Mapel::all();
        return view('admin.mapel', compact('mapels'));
    }

    public function ekskul()
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses khusus Admin.');
        }

        $ekskuls = Ekskul::all();
        return view('admin.ekskul', compact('ekskuls'));
    }

    public function laporan()
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses khusus Admin.');
        }

        // Ambil data statistik / laporan
        $siswaCount = Siswa::count();
        $guruCount = Guru::count();

        return view('admin.laporan', compact('siswaCount', 'guruCount'));
    }

    public function index()
    {

        // 🔹 Cek apakah user login dan role = admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses khusus Admin.');
        }

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
        // Rata-rata Partisipasi per Ekskul
        // ----------------------------
        $daftar_ekskul = PenilaianEkskul::all();

        $rata_partisipasi_per_ekskul = [];

        foreach ($daftar_ekskul as $ekskul) {
            $avg = PenilaianEkskul::where('siswa_ekskul_id', $ekskul->id)->avg('tingkat_partisipasi');

            $rata_partisipasi_per_ekskul[$ekskul->nama] = round($avg ?? 0, 2);
        }

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
            'rata_partisipasi_per_ekskul' => $rata_partisipasi_per_ekskul,
        ]);
    }

    public function createUser()
    {
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:guru,pembina,siswa',
        ]);

        // 🔹 Simpan ke tabel users
        $user = \App\Models\User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        // 🔹 Masukkan ke tabel lain berdasarkan role
        if ($request->role === 'guru') {
            Guru::create([
                'user_id' => $user->id,
                'namaGuru' => $request->namaGuru,
                'mapel' => $request->mapel,
                'nip' => $request->nip,
            ]);
        }

        if ($request->role === 'pembina') {
            Pembina::create([
                'user_id' => $user->id,
                'nama' => $request->namaPembina,
            ]);
        }

        if ($request->role === 'siswa') {
            Siswa::create([
                'user_id' => $user->id,
                'kelas_id' => $request->kelas_id,
                'namaSiswa' => $request->namaSiswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nis' => $request->nis,
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan.');
    }

    public function editUser($id)
    {
        $user = \App\Models\User::findOrFail($id);

        return view('admin.users-edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Update data tabel role tertentu
        if ($user->role === 'guru') {
            $user->guru->update([
                'namaGuru' => $user->username, // otomatis ambil username
                'mapel' => $request->mapel,
                'nip' => $request->nip,
            ]);
        }

        if ($user->role === 'pembina') {
            $user->pembina->update([
                'nama' => $request->namaPembina,
            ]);
        }

        if ($user->role === 'siswa') {
            $user->siswa->update([
                'kelas_id' => $request->kelas_id,
                'namaSiswa' => $request->namaSiswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nis' => $request->nis,
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui.');
    }

    public function deleteUser($id)
    {
        $user = \App\Models\User::findOrFail($id);

        // Hapus data tabel lain juga
        if ($user->role === 'guru') {
            $user->guru()->delete();
        }
        if ($user->role === 'pembina') {
            $user->pembina()->delete();
        }
        if ($user->role === 'siswa') {
            $user->siswa()->delete();
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }


}
