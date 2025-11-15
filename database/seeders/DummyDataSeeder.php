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

            // ✅ gunakan kolom 'nama' (bukan 'namaPembina')
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
            // Assign wali kelas yang berbeda untuk setiap kelas
            $waliKelasId = Arr::random($guruIds); // Pilih wali kelas secara acak dari guru yang ada
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
                        'nilai' => rand(10, 95),
                        'guru_id' => $guruIds[$mapel],
                        'catatan' => "Nilai UAS {$namaSiswa}",
                    ]);

                    DB::table('siswa')->where('id', $siswaId)->update([
                        'uts_id' => $utsId,
                        'uas_id' => $uasId,
                    ]);
                }

                // ===== CATATAN PEMBINA =====
                $randomPembinaId = Arr::random($pembinaIds);
                DB::table('catatan_pembina')->insert([
                    'siswa_id' => $siswaId,
                    'pembina_id' => $randomPembinaId, // ✅ tambahkan relasi pembina
                    'namaAnggota' => $namaSiswa,
                    'tingkat_partisipasi' => rand(80, 100),
                    'tingkat_keterampilan' => Arr::random(['Pemula', 'Menengah', 'Mahir']),
                    'catatan' => 'Aktif dalam kegiatan ekskul dan menunjukkan semangat belajar tinggi.',
                    'potensi' => 'Kemampuan kepemimpinan dan kerja sama yang baik.',
                    'rekomendasi_pengembangan' => 'Dapat diberi tanggung jawab tambahan seperti ketua kelompok.',
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
                'nama' => $namaEkskul, // ✅ sesuaikan dengan model Ekskul
                'pembina_id' => $pembinaId,
            ]);
            $ekskulIds[$namaEkskul] = $ekskulId;

            // ✅ sinkronkan ke tabel pembina
            DB::table('pembina')->where('id', $pembinaId)->update([
                'ekskul_id' => $ekskulId,
            ]);
        }

        // ===== ATTACH SISWA KE EKSKUL =====
        foreach ($siswaIds as $siswaId) {
            $chosenEkskul = array_rand($ekskulIds, rand(1, 2));
            if (!is_array($chosenEkskul)) {
                $chosenEkskul = [$chosenEkskul];
            }

            foreach ($chosenEkskul as $eks) {
                DB::table('siswa_ekskul')->insert([
                    'siswa_id' => $siswaId,
                    'ekskul_id' => $ekskulIds[$eks],
                    'tingkat_keterampilan' => Arr::random(['Pemula', 'Menengah', 'Mahir']),
                    'tingkat_partisipasi' => rand(50, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        // ===== GURU MENGAJAR KELAS =====
        $kelasIdsArray = array_values($kelasIds); // ambil ID kelas sebagai array
        foreach ($guruIds as $mapel => $guruId) {
            // Pilih 1-2 kelas acak yang diajar setiap guru
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