<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // === USERS ===
        $userAdmin = DB::table('users')->insertGetId([
            'username' =>'Admin1',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // === GURU ===
        $mapelList = [
            'Bahasa Indonesia',
            'Matematika',
            'IPA',
            'IPS',
            'Seni Budaya',
            'PJOK',
        ];

        $guruIds = [];
        foreach ($mapelList as $index => $mapel) {
            $userGuru = DB::table('users')->insertGetId([
                'username' => "Guru" . ($index + 1),
                'email' => "guru{$index}@example.com",
                'password' => Hash::make('password'),
                'role' => 'guru',
            ]);

            $guruId = DB::table('guru')->insertGetId([
                'user_id' => $userGuru,
                'namaGuru' => "Guru {$mapel}",
                'mapel' => $mapel,
                'nip' => '1000' . ($index + 1),
            ]);

            $guruIds[$mapel] = $guruId;
        }

        // === PEMBINA ===
        $pembinaList = ['Bu Rina', 'Pak Dedi'];
        $pembinaIds = [];
        foreach ($pembinaList as $index => $nama) {
            $userPembina = DB::table('users')->insertGetId([
                'username' => $nama,
                'email' => "pembina{$index}@example.com",
                'password' => Hash::make('password'),
                'role' => 'pembina',
            ]);

            $pembinaId = DB::table('pembina')->insertGetId([
                'user_id' => $userPembina,
                'namaPembina' => $nama,
            ]);

            $pembinaIds[] = $pembinaId;
        }

        // === KELAS ===
        $kelasList = ['2A', '2B', '2C'];
        $kelasIds = [];
        foreach ($kelasList as $index => $namaKelas) {
            // Wali kelas pilih guru matematika secara acak
            $waliKelasId = $guruIds['Matematika'];

            $kelasId = DB::table('kelas')->insertGetId([
                'namaKelas' => $namaKelas,
                'waliKelas_id' => $waliKelasId,
            ]);

            $kelasIds[$namaKelas] = $kelasId;
        }

        // === SISWA ===
        $siswaList = [
            '2A' => ['Andi', 'Budi'],
            '2B' => ['Citra', 'Deni'],
            '2C' => ['Eka', 'Fajar'],
        ];

        $siswaIds = [];
        foreach ($siswaList as $kelas => $siswas) {
            foreach ($siswas as $index => $namaSiswa) {
                $userSiswa = DB::table('users')->insertGetId([
                    'username' => $namaSiswa,
                    'email' => strtolower($namaSiswa) . "@example.com",
                    'password' => Hash::make('password'),
                    'role' => 'siswa',
                ]);

                // Menambahkan jenis_kelamin untuk siswa
                $jenisKelamin = ($index % 2 == 0) ? 'L' : 'P'; // Alternating gender for simplicity

                $siswaId = DB::table('siswa')->insertGetId([
                    'user_id' => $userSiswa,
                    'namaSiswa' => $namaSiswa,
                    'nis' => '20250' . ($index + 1 + array_search($kelas, array_keys($siswaList)) * 2),
                    'kelas_id' => $kelasIds[$kelas],
                    'jenis_kelamin' => $jenisKelamin, // Added gender
                ]);

                $siswaIds[] = $siswaId;

                // === UTS & UAS ===
                $utsId = DB::table('uts')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'Matematika',
                    'nilai' => rand(70, 90),
                    'guru_id' => $guruIds['Matematika'], // Menambahkan guru_id
                    'catatan' => 'Nilai UTS ' . $namaSiswa, // Jika kolom catatan ada
                ]);

                $uasId = DB::table('uas')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'Matematika',
                    'nilai' => rand(75, 95),
                    'guru_id' => $guruIds['Matematika'], // Menambahkan guru_id
                    'catatan' => 'Nilai UAS ' . $namaSiswa,
                ]);

                $utsId = DB::table('uts')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'IPA',
                    'nilai' => rand(70, 90),
                    'guru_id' => $guruIds['IPA'], // Menambahkan guru_id
                    'catatan' => 'Nilai UTS ' . $namaSiswa, // Jika kolom catatan ada
                ]);

                $uasId = DB::table('uas')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'IPA',
                    'nilai' => rand(75, 95),
                    'guru_id' => $guruIds['IPA'], // Menambahkan guru_id
                    'catatan' => 'Nilai UAS ' . $namaSiswa,
                ]);

                $utsId = DB::table('uts')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => rand(70, 90),
                    'guru_id' => $guruIds['Bahasa Indonesia'], // Menambahkan guru_id
                    'catatan' => 'Nilai UTS ' . $namaSiswa, // Jika kolom catatan ada
                ]);

                $uasId = DB::table('uas')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => rand(75, 95),
                    'guru_id' => $guruIds['Bahasa Indonesia'], // Menambahkan guru_id
                    'catatan' => 'Nilai UAS ' . $namaSiswa,
                ]);
                
                $utsId = DB::table('uts')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'IPS',
                    'nilai' => rand(70, 90),
                    'guru_id' => $guruIds['IPS'], // Menambahkan guru_id
                    'catatan' => 'Nilai UTS ' . $namaSiswa, // Jika kolom catatan ada
                ]);

                $uasId = DB::table('uas')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'IPS',
                    'nilai' => rand(75, 95),
                    'guru_id' => $guruIds['IPS'], // Menambahkan guru_id
                    'catatan' => 'Nilai UAS ' . $namaSiswa,
                ]);
                
                $utsId = DB::table('uts')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'PJOK',
                    'nilai' => rand(70, 90),
                    'guru_id' => $guruIds['PJOK'], // Menambahkan guru_id
                    'catatan' => 'Nilai UTS ' . $namaSiswa, // Jika kolom catatan ada
                ]);

                $uasId = DB::table('uas')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'PJOK',
                    'nilai' => rand(75, 95),
                    'guru_id' => $guruIds['PJOK'], // Menambahkan guru_id
                    'catatan' => 'Nilai UAS ' . $namaSiswa,
                ]);
                
                $utsId = DB::table('uts')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'Seni Budaya',
                    'nilai' => rand(70, 90),
                    'guru_id' => $guruIds['Seni Budaya'], // Menambahkan guru_id
                    'catatan' => 'Nilai UTS ' . $namaSiswa, // Jika kolom catatan ada
                ]);

                $uasId = DB::table('uas')->insertGetId([
                    'siswa_id' => $siswaId,
                    'namaSiswa' => $namaSiswa,
                    'mapel' => 'Seni Budaya',
                    'nilai' => rand(75, 95),
                    'guru_id' => $guruIds['Seni Budaya'], // Menambahkan guru_id
                    'catatan' => 'Nilai UAS ' . $namaSiswa,
                ]);          

                DB::table('siswa')->where('id', $siswaId)->update([
                    'uts_id' => $utsId,
                    'uas_id' => $uasId,
                ]);

                // === CATATAN PEMBINA ===
                $pembinaId = $pembinaIds[array_rand($pembinaIds)];
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

        // === EKSKUL ===
        $ekskulList = ['Pramuka', 'Basket', 'Marching Band', 'Robotics'];
        foreach ($ekskulList as $index => $namaEkskul) {
            foreach ($siswaIds as $siswaId) {
                $pembinaId = $pembinaIds[$index % count($pembinaIds)];
                DB::table('ekskul')->insert([
                    'namaEkskul' => $namaEkskul,
                    'pembina_id' => $pembinaId,
                    'anggota_id' => $siswaId,
                ]);
            }
        }
    }
}
