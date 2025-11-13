<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

// class TestRelasiSeeder extends Seeder
// {
//     public function run(): void
//     {
//         // ==== Tambah data UTS ====
//         $utsId = DB::table('uts')->insertGetId([
//             'siswa_id' => 1, // pastikan siswa dengan id=1 sudah ada
//             'mapel' => 'Matematika',
//             'nilai' => 88,
//             'catatan' => 'Perkembangan sangat baik di bab aljabar',
//         ]);

//         // ==== Tambah data UAS ====
//         $uasId = DB::table('uas')->insertGetId([
//             'siswa_id' => 1,
//             'mapel' => 'Matematika',
//             'nilai' => 92,
//             'catatan' => 'Meningkat signifikan dibanding UTS',
//         ]);

//         // ==== Update siswa untuk hubungkan ke nilai tersebut ====
//         DB::table('siswa')
//             ->where('id', 1)
//             ->update([
//                 'uts_id' => $utsId,
//                 'uas_id' => $uasId,
//             ]);
//     }
// }
