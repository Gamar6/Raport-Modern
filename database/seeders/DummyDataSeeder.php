<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // ===== USERS ADMIN =====
        DB::table('users')->insert([
            'username' => 'Admin1',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // ===== MAPEL =====
        $mapelList = ['Bahasa Indonesia', 'Matematika', 'IPA', 'IPS', 'Seni Budaya', 'PJOK'];

        // ===== GURU =====
        $guruIds = [];
        foreach ($mapelList as $index => $mapel) {
            $userGuruId = DB::table('users')->insertGetId([
                'username' => "Guru" . ($index + 1),
                'email' => "guru{$index}@example.com",
                'password' => Hash::make('password'),
                'role' => 'guru',
            ]);

            $guruId = DB::table('guru')->insertGetId([
                'user_id' => $userGuruId,
                'namaGuru' => "Guru {$mapel}",
                'mapel' => $mapel,
                'nip' => '1000' . ($index + 1),
            ]);

            $guruIds[$mapel] = $guruId;
        }

        // ===== PEMBINA =====
        $pembinaList = ['Bu Rina', 'Pak Dedi', 'Pak Budi', 'Bu Sari'];
        $pembinaIds = [];
        foreach ($pembinaList as $index => $nama) {
            $userPembinaId = DB::table('users')->insertGetId([
                'username' => $nama,
                'email' => "pembina{$index}@example.com",
                'password' => Hash::make('password'),
                'role' => 'pembina',
            ]);

            $pembinaId = DB::table('pembina')->insertGetId([
                'user_id' => $userPembinaId,
                'nama' => $nama,
            ]);

            $pembinaIds[$nama] = $pembinaId;
        }

        // ===== KELAS =====
        $kelasList = ['2A', '2B', '2C'];
        $kelasIds = [];
        foreach ($kelasList as $namaKelas) {
            $waliKelasId = Arr::random($guruIds);
            $kelasIds[$namaKelas] = DB::table('kelas')->insertGetId([
                'namaKelas' => $namaKelas,
                'waliKelas_id' => $waliKelasId,
            ]);
        }

        // ===== SISWA (20-30 per kelas) =====
        $siswaIds = [];
        foreach ($kelasList as $kelas) {
            for ($i = 1; $i <= rand(20, 30); $i++) {
                $namaSiswa = "Siswa {$kelas}{$i}";
                $userSiswaId = DB::table('users')->insertGetId([
                    'username' => $namaSiswa,
                    'email' => strtolower($namaSiswa) . "@example.com",
                    'password' => Hash::make('password'),
                    'role' => 'siswa',
                ]);

                $jenisKelamin = ($i % 2 == 0) ? 'P' : 'L';

                $siswaId = DB::table('siswa')->insertGetId([
                    'user_id' => $userSiswaId,
                    'namaSiswa' => $namaSiswa,
                    'nis' => '2025' . str_pad($i + array_search($kelas, $kelasList) * 100, 3, '0', STR_PAD_LEFT),
                    'kelas_id' => $kelasIds[$kelas],
                    'jenis_kelamin' => $jenisKelamin,
                ]);

                $siswaIds[] = $siswaId;

                // ===== NILAI UTS & UAS =====
                foreach ($mapelList as $mapel) {
                    $utsId = DB::table('uts')->insertGetId([
                        'siswa_id' => $siswaId,
                        'namaSiswa' => $namaSiswa,
                        'mapel' => $mapel,
                        'nilai' => rand(50, 100),
                        'guru_id' => $guruIds[$mapel],
                        'catatan' => "Nilai UTS {$namaSiswa}",
                    ]);

                    $uasId = DB::table('uas')->insertGetId([
                        'siswa_id' => $siswaId,
                        'namaSiswa' => $namaSiswa,
                        'mapel' => $mapel,
                        'nilai' => rand(50, 100),
                        'guru_id' => $guruIds[$mapel],
                        'catatan' => "Nilai UAS {$namaSiswa}",
                    ]);

                    DB::table('siswa')->where('id', $siswaId)->update([
                        'uts_id' => $utsId,
                        'uas_id' => $uasId,
                    ]);
                }
            }
        }

        // ===== EKSKUL =====
        $ekskulList = [
            'Pramuka' => 'Bu Rina',
            'Basket' => 'Pak Budi',
            'Marching Band' => 'Bu Sari',
            'Robotics' => 'Pak Dedi',
        ];

        $ekskulIds = [];
        foreach ($ekskulList as $namaEkskul => $namaPembina) {
            $pembinaId = $pembinaIds[$namaPembina];
            $ekskulId = DB::table('ekskul')->insertGetId([
                'nama' => $namaEkskul,
                'pembina_id' => $pembinaId,
            ]);
            $ekskulIds[$namaEkskul] = $ekskulId;

            DB::table('pembina')->where('id', $pembinaId)->update([
                'ekskul_id' => $ekskulId,
            ]);
        }

        // ===== ATTACH SISWA KE EKSKUL (1-3 ekskul per siswa) =====
        foreach ($siswaIds as $siswaId) {
            $jumlahEkskul = rand(1, 3);
            $chosenEkskul = array_rand($ekskulIds, $jumlahEkskul);
            if (!is_array($chosenEkskul)) {
                $chosenEkskul = [$chosenEkskul];
            }

            foreach ($chosenEkskul as $eks) {
                $siswaEkskulId = DB::table('siswa_ekskul')->insertGetId([
                    'siswa_id' => $siswaId,
                    'ekskul_id' => $ekskulIds[$eks],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // ===== PENILAIAN PEMBINA =====
                DB::table('penilaian_ekskul')->insert([
                    'siswa_ekskul_id' => $siswaEkskulId,
                    'tingkat_partisipasi' => rand(50, 100),
                    'tingkat_keterampilan' => Arr::random(['Pemula', 'Menengah', 'Mahir']),
                    'catatan' => Arr::random([
                        'Sangat aktif, selalu hadir tepat waktu.',
                        'Perlu peningkatan dalam kerja sama tim.',
                        'Menunjukkan kreativitas tinggi.',
                        'Perlu lebih fokus pada latihan.',
                        'Berpotensi menjadi ketua kelompok.'
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // ===== GURU MENGAJAR KELAS =====
        $kelasIdsArray = array_values($kelasIds);
        foreach ($guruIds as $mapel => $guruId) {
            $kelasDiajar = Arr::random($kelasIdsArray, rand(3, 3));
            if (!is_array($kelasDiajar)) {
                $kelasDiajar = [$kelasDiajar];
            }

            foreach ($kelasDiajar as $kelasId) {
                DB::table('guru_kelas')->insert([
                    'guru_id' => $guruId,
                    'kelas_id' => $kelasId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
