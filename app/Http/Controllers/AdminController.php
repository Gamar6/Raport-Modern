<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Import Semua Model
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pembina;
use App\Models\Ekskul;
use App\Models\Kelas;
use App\Models\Uts;
use App\Models\Uas;
use App\Models\CatatanPembina;
use App\Models\PenilaianEkskul;

class AdminController extends Controller
{
    // ========================================================================
    // 1. DASHBOARD UTAMA
    // ========================================================================
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses khusus Admin.');
        }

        // A. Ringkasan Data
        $total_siswa   = Siswa::count();
        $total_guru    = Guru::count();
        $total_pembina = Pembina::count();
        $total_ekskul  = Ekskul::count();

        // B. Progress Pengisian Nilai
        $total_mapel = max(1, $total_guru); 
        $target_nilai = $total_siswa * $total_mapel;
        $isi_uts = Uts::count();
        $isi_uas = Uas::count();

        $progress_uts = $target_nilai > 0 ? round(($isi_uts / $target_nilai) * 100, 1) : 0;
        $progress_uas = $target_nilai > 0 ? round(($isi_uas / $target_nilai) * 100, 1) : 0;
        $persentase_guru = round(($progress_uts + $progress_uas) / 2, 1);

        // C. Progress Pembina
        $total_catatan = CatatanPembina::count();
        $persentase_pembina = $total_siswa > 0 ? round(($total_catatan / $total_siswa) * 100, 1) : 0;

        // D. Grafik Rata-rata Nilai per Mapel
        $daftarMapel = Guru::whereNotNull('mapel')->where('mapel', '!=', '-')->pluck('mapel')->unique();
        $nilai_mapel = [];
        foreach ($daftarMapel as $mapel) {
            $avgUts = Uts::where('mapel', $mapel)->avg('nilai');
            $avgUas = Uas::where('mapel', $mapel)->avg('nilai');
            $avg = ($avgUts && $avgUas) ? ($avgUts + $avgUas) / 2 : ($avgUts ?? $avgUas ?? 0);
            $nilai_mapel[$mapel] = round($avg, 2);
        }
        if (empty($nilai_mapel)) $nilai_mapel = ['Belum ada data' => 0];

        // E. Grafik Partisipasi Ekskul
        $listEkskul = Ekskul::all();
        $rata_partisipasi_per_ekskul = [];

        foreach ($listEkskul as $eks) {
            $avg = PenilaianEkskul::join('siswa_ekskul', 'penilaian_ekskul.siswa_ekskul_id', '=', 'siswa_ekskul.id')
                ->where('siswa_ekskul.ekskul_id', $eks->id)
                ->avg('penilaian_ekskul.tingkat_partisipasi');
            
            $rata_partisipasi_per_ekskul[$eks->nama] = round($avg ?? 0, 2);
        }
        if (empty($rata_partisipasi_per_ekskul)) $rata_partisipasi_per_ekskul = ['Belum ada data' => 0];

        // F. Data Dummy
        $perkembangan_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
        $perkembangan_values = [0, 0, 0, 0, 0, 0];
        $rata_rata_semua_siswa = 0;

        return view('admin.admin', compact(
            'total_siswa', 'total_guru', 'total_pembina', 'total_ekskul',
            'persentase_guru', 'persentase_pembina',
            'nilai_mapel', 'rata_partisipasi_per_ekskul',
            'perkembangan_labels', 'perkembangan_values', 'rata_rata_semua_siswa',
            'progress_uts', 'progress_uas'
        ));
    }

    // ========================================================================
    // 2. MANAJEMEN PENGGUNA (USERS)
    // ========================================================================
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        $kelas = Kelas::all(); // Kirim data kelas ke view
        return view('admin.create-user', compact('kelas'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,guru,siswa,pembina',
            'nama_lengkap' => 'required|string|max:255', 
        ]);

        DB::transaction(function () use ($request) {
            // 1. Buat Akun
            $user = User::create([
                'username' => $request->username,
                'email'    => $request->email,
                'password' => $request->password, // Model akan handle bcrypt
                'role'     => $request->role,
            ]);

            // 2. Buat Profil
            if ($request->role === 'guru') {
                Guru::create([
                    'user_id'  => $user->id,
                    'namaGuru' => $request->nama_lengkap, 
                    'mapel'    => '-', 
                    'nip'      => '0'
                ]);
            } elseif ($request->role === 'siswa') {
                Siswa::create([
                    'user_id'   => $user->id,
                    'namaSiswa' => $request->nama_lengkap,
                    'nis'       => $request->nis ?? '0', 
                    'kelas_id'  => $request->kelas_id, 
                    'jenis_kelamin' => $request->jenis_kelamin ?? 'L'
                ]);
            } elseif ($request->role === 'pembina') {
                Pembina::create([
                    'user_id' => $user->id,
                    'nama'    => $request->nama_lengkap,
                ]);
            }
        });

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function editUser($id)
    {
        $user = User::with(['guru', 'siswa', 'pembina'])->findOrFail($id);
        $kelas = Kelas::all(); 

        $currentName = $user->username;
        if ($user->role === 'guru' && $user->guru) $currentName = $user->guru->namaGuru;
        elseif ($user->role === 'siswa' && $user->siswa) $currentName = $user->siswa->namaSiswa;
        elseif ($user->role === 'pembina' && $user->pembina) $currentName = $user->pembina->nama;

        return view('admin.users-edit', compact('user', 'currentName', 'kelas'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'email'    => 'required|email|unique:users,email,' . $id,
            'role'     => 'required|in:admin,guru,siswa,pembina',
        ]);

        $dataAcc = [
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
        ];
        if ($request->filled('password')) {
            $dataAcc['password'] = $request->password; 
        }
        $user->update($dataAcc);

        // Update Profil
        if ($request->filled('name')) {
            if ($user->role === 'guru') {
                Guru::updateOrCreate(['user_id' => $user->id], ['namaGuru' => $request->name]);
            } elseif ($user->role === 'siswa') {
                $siswaData = ['namaSiswa' => $request->name];
                if ($request->filled('nis')) $siswaData['nis'] = $request->nis;
                if ($request->filled('kelas_id')) $siswaData['kelas_id'] = $request->kelas_id;
                if ($request->filled('jenis_kelamin')) $siswaData['jenis_kelamin'] = $request->jenis_kelamin;
                
                Siswa::updateOrCreate(['user_id' => $user->id], $siswaData);
            } elseif ($user->role === 'pembina') {
                Pembina::updateOrCreate(['user_id' => $user->id], ['nama' => $request->name]);
            }
        }

        return redirect()->route('admin.users')->with('success', 'Data pengguna diperbarui.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->guru) $user->guru->delete();
        if ($user->siswa) $user->siswa->delete();
        if ($user->pembina) $user->pembina->delete();

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    // ========================================================================
    // 3. MANAJEMEN MATA PELAJARAN (Via Tabel Guru)
    // ========================================================================
    public function mapel()
    {
        $gurus = Guru::all();
        return view('admin.mapel', compact('gurus'));
    }

    public function editMapel($id)
    {
        $guru = Guru::with('kelas')->findOrFail($id);
        $semuaKelas = Kelas::orderBy('namaKelas', 'asc')->get();
        return view('admin.mapel-edit', compact('guru', 'semuaKelas'));
    }

    public function updateMapel(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'namaGuru' => 'required|string|max:255',
            'nip'      => 'required|string|max:50',
            'mapel'    => 'required|string|max:100',
            'kelas'    => 'array',
            'kelas.*'  => 'exists:kelas,id',
        ]);

        $guru->update([
            'namaGuru' => $request->namaGuru,
            'nip'      => $request->nip,
            'mapel'    => $request->mapel,
        ]);

        $guru->kelas()->sync($request->kelas ?? []);

        return redirect()->route('admin.mapel')->with('success', 'Data pengampu berhasil diperbarui.');
    }

    // ========================================================================
    // 4. MANAJEMEN EKSTRAKURIKULER
    // ========================================================================
    public function ekskul()
    {
        $pembinas = Pembina::with('ekskul')->get();
        return view('admin.ekskul', compact('pembinas'));
    }

    public function editEkskul($id)
    {
        $pembina = Pembina::findOrFail($id);
        $ekskuls = Ekskul::all();
        return view('admin.ekskul-edit', compact('pembina', 'ekskuls'));
    }

    public function updateEkskul(Request $request, $id)
    {
        $pembina = Pembina::findOrFail($id);

        $request->validate([
            'nama'            => 'required|string|max:255',
            'ekskul_id'       => 'nullable|exists:ekskul,id',
            'new_ekskul_nama' => 'nullable|string|max:255|unique:ekskul,nama'
        ]);

        DB::transaction(function () use ($request, $pembina) {
            $targetEkskulId = $request->ekskul_id;

            // Logika Buat Ekskul Baru
            if ($request->filled('new_ekskul_nama')) {
                $newEkskul = Ekskul::create(['nama' => $request->new_ekskul_nama]);
                $targetEkskulId = $newEkskul->id;
            }

            // Logika Perebutan Ekskul
            if ($targetEkskulId) {
                $prevOwner = Pembina::where('ekskul_id', $targetEkskulId)
                                    ->where('id', '!=', $pembina->id)
                                    ->first();
                if ($prevOwner) {
                    $prevOwner->update(['ekskul_id' => null]);
                }
            }

            $pembina->update([
                'nama'      => $request->nama,
                'ekskul_id' => $targetEkskulId
            ]);
        });

        return redirect()->route('admin.ekskul')->with('success', 'Data pembina & ekskul diperbarui.');
    }

    // ========================================================================
    // 5. LAPORAN
    // ========================================================================
    public function laporan()
    {
        $siswaCount = Siswa::count();
        $guruCount  = Guru::count();
        return view('admin.laporan', compact('siswaCount', 'guruCount'));
    }
}