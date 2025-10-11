<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    public function nilaiSiswa()
{
    return $this->hasMany(NilaiSiswa::class);
}

}
