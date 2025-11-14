<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uas extends Model
{
    protected $table = 'uas';
    protected $fillable = ['siswa_id', 'nilai', 'mapel', 'catatan'];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function guru()
    {
        return $this->belongsTo(\App\Models\Guru::class, 'guru_id');
    }

}
