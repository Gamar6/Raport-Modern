<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'namaPembina' => $nama,
            ]);

            $pembinaIds[$nama] = $pembinaId;
        }

        // ===== KELAS =====
        $kelasList = ['2A', '2B', '2C'];
        $kelasIds = [];
        foreach ($kelasList as $namaKelas) {
            $waliKelasId = $guruIds['Matematika']; // contoh wali kelas
            $kelasIds[$namaKelas] = DB::table('kelas')->insertGetId([
                'namaKelas' => $namaKelas,
                'waliKelas_id' => $waliKelasId,
            ]);
        }

        // ===== SISWA =====
        $siswaList = [
            '2A' => ['Andi', 'Budi'],
            '2B' => ['Citra', 'Deni'],
            '2C' => ['Eka', 'Fajar'],
        ];

        $siswaIds = [];
        foreach ($siswaList as $kelas => $siswas) {
            foreach ($siswas as $index => $namaSiswa) {
                $userSiswaId = DB::table('users')->insertGetId([
                    'username' => $namaSiswa,
                    'email' => strtolower($namaSiswa) . "@example.com",
                    'password' => Hash::make('password'),
                    'role' => 'siswa',
                ]);

                $jenisKelamin = ($index % 2 == 0) ? 'L' : 'P';

                $siswaId = DB::table('siswa')->insertGetId([
                    'user_id' => $userSiswaId,
                    'namaSiswa' => $namaSiswa,
                    'nis' => '20250' . ($index + 1 + array_search($kelas, array_keys($siswaList)) * 2),
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
                        'nilai' => rand(70, 90),
                        'guru_id' => $guruIds[$mapel],
                        'catatan' => "Nilai UTS {$namaSiswa}",
                    ]);

                    $uasId = DB::table('uas')->insertGetId([
                        'siswa_id' => $siswaId,
                        'namaSiswa' => $namaSiswa,
                        'mapel' => $mapel,
                        'nilai' => rand(75, 95),
                        'guru_id' => $guruIds[$mapel],
                        'catatan' => "Nilai UAS {$namaSiswa}",
                    ]);

                    // Update siswa dengan UTS/UAS terakhir mapel
                    DB::table('siswa')->where('id', $siswaId)->update([
                        'uts_id' => $utsId,
                        'uas_id' => $uasId,
                    ]);
                }

                // ===== CATATAN PEMBINA =====
                $randomPembinaId = $pembinaIds[array_rand($pembinaIds)];
                DB::table('catatan_pembina')->insert([
                    'siswa_id' => $siswaId,
                    'namaAnggota' => $namaSiswa,
                    'tingkat_partisipasi' => rand(80, 100),
                    'tingkat_keterampilan' => 'Mahir',
                    'catatan' => 'Aktif dalam kegiatan kelas dan ekskul',
                    'potensi' => 'Kemampuan kepemimpinan dan kerja sama baik',
                    'rekomendasi_pengembangan' => 'Dapat diberi tanggung jawab tambahan',
                ]);
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
                'namaEkskul' => $namaEkskul,
                'pembina_id' => $pembinaId,
            ]);
            $ekskulIds[$namaEkskul] = $ekskulId;
        }

        // ===== ATTACH SISWA KE EKSKUL (pivot table siswa_ekskul) =====
        foreach ($siswaIds as $siswaId) {
            // tiap siswa ikut 1–2 ekskul random
            $chosenEkskul = array_rand($ekskulIds, rand(1,2));
            if (!is_array($chosenEkskul)) {
                $chosenEkskul = [$chosenEkskul];
            }

            foreach ($chosenEkskul as $eks) {
                DB::table('siswa_ekskul')->insert([
                    'siswa_id' => $siswaId,
                    'ekskul_id' => $ekskulIds[$eks],
                    'tingkat_keterampilan' => rand(50,100),
                    'tingkat_partisipasi' => rand(50,100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
