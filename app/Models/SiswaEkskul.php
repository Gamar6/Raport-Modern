<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaEkskul extends Model
{
    protected $table = 'siswa_ekskul';
    protected $fillable = ['siswa_id', 'ekskul_id', 'tingkat_keterampilan', 'tingkat_partisipasi'];

    // 🔹 Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // 🔹 Relasi ke Ekskul
    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class);
    }
}
