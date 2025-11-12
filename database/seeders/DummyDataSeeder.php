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
        $userGuru = DB::table('users')->insertGetId([
            'username' => 'Pak Budi',
            'email' => 'guru@example.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);

        $userSiswa = DB::table('users')->insertGetId([
            'username' => 'Andi',
            'email' => 'siswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        $userPembina = DB::table('users')->insertGetId([
            'username' => 'Bu Rina',
            'email' => 'pembina@example.com',
            'password' => Hash::make('password'),
            'role' => 'pembina',
        ]);

        // === GURU ===
        $guruId = DB::table('guru')->insertGetId([
            'user_id' => $userGuru,
            'namaGuru' => 'Pak Budi',
            'mapel' => 'Matematika',
            'nip' => '123456789',
        ]);

        // === PEMBINA ===
        $pembinaId = DB::table('pembina')->insertGetId([
            'user_id' => $userPembina,
            'namaPembina' => 'Bu Rina',
        ]);

        // === KELAS ===
        $kelasId = DB::table('kelas')->insertGetId([
            'namaKelas' => 'X IPA 1',
            'waliKelas_id' => $guruId,
        ]);

        // === SISWA ===
        $siswaId = DB::table('siswa')->insertGetId([
            'user_id' => $userSiswa,
            'namaSiswa' => 'Andi',
            'nis' => '202501',
            'kelas_id' => $kelasId,
        ]);

        // === EKSKUL ===
        DB::table('ekskul')->insert([
            'namaEkskul' => 'Pramuka',
            'pembina_id' => $pembinaId,
            'anggota_id' => $siswaId,
        ]);

        // === NILAI (UTS & UAS) ===
        DB::table('uts')->insert([
            'siswa_id' => $siswaId,
            'mapel' => 'Matematika',
            'nilai' => 85,
            'catatan' => 'Perlu meningkatkan konsentrasi saat ujian.',
        ]);

        DB::table('uas')->insert([
            'siswa_id' => $siswaId,
            'mapel' => 'Matematika',
            'nilai' => 90,
            'catatan' => 'Kemajuan signifikan dari UTS!',
        ]);

        // === CATATAN PEMBINA ===
        DB::table('catatan_pembina')->insert([
            'siswa_id' => $siswaId,
            'namaAnggota' => 'Andi',
            'tingkat_partisipasi' => '100',
            'tingkat_keterampilan' => 'Mahir',
            'catatan' => 'Selalu hadir dan disiplin dalam setiap kegiatan.',
            'potensi' => 'Memiliki kemampuan kepemimpinan yang baik.',
            'rekomendasi_pengembangan' => 'Dapat diberi tanggung jawab sebagai ketua regu tahun depan.',
        ]);
    }
}
