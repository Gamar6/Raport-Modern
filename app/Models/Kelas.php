<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'waliKelas_id'];

    // Relasi ke Wali Kelas
    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'waliKelas_id');
    }

    // Relasi ke Guru
    public function guru()
    {
        return $this->belongsToMany(Guru::class, 'guru_kelas', 'kelas_id', 'guru_id');
    }

    // Relasi ke siswa
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
}
