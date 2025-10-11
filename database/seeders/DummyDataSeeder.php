<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\NilaiSiswa;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $mapel = [
            'Matematika', 'IPA', 'IPS', 'PAI', 'Bahasa Indonesia', 'Bahasa Inggris'
        ];

        for ($i = 1; $i <= 5; $i++) {
            $siswa = Siswa::create(['nama' => 'Siswa ' . $i]);

            foreach ($mapel as $m) {
                NilaiSiswa::create([
                    'siswa_id' => $siswa->id,
                    'mapel' => $m,
                    'nilai' => rand(60, 100),
                ]);
            }
        }
    }
}
