<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uts extends Model
{
    protected $table = 'uts';
    protected $fillable = ['siswa_id', 'namaSiswa', 'mapel', 'nilai', 'guru_id', 'catatan'];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

}
