<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Jalankan seeder untuk data dummy dasar
        $this->call(DummyDataSeeder::class);

        // Jalankan seeder tambahan untuk relasi dan nilai
        $this->call(TestRelasiSeeder::class);
    }
}
