<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserSeeders extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'nama' => 'admin01',
                'password' => Hash::make('administrator'), // Hashing password
                'role' => 'admin',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'nama' => 'guru_budi',
                'password' => Hash::make('Budi Santoso'),
                'role' => 'guru',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Tambah data lainnya di sini
        ]);
    }
}
