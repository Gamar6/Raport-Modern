<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = [
        'user_id',
        'namaGuru',
        'mapel',
        'nip',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Kelas yang dia jadi wali
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'guru_kelas', 'guru_id', 'kelas_id');
    }

    public function guruKelas()
    {
        return $this->hasMany(GuruKelas::class);
    }

    // Jika ingin langsung mengambil daftar kelas
    public function kelasDiampu()
    {
        return $this->belongsToMany(Kelas::class, 'guru_kelas');
    }

    public function kelasDiajarkan()
    {
        return $this->belongsToMany(Kelas::class, 'guru_kelas', 'guru_id', 'kelas_id');
    }

    public function uts()
    {
        return $this->hasMany(Uts::class, 'guru_id');
    }

    // Guru punya banyak nilai UAS yang dia berikan (FK: guru_id ada di tabel uas)
    public function uas()
    {
        return $this->hasMany(Uas::class, 'guru_id');
    }

}
