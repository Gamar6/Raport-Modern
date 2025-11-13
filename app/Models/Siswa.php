<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['user_id', 'kelas_id', 'uts_id', 'uas_id', 'nis', 'tingkat'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke UTS
    public function uts()
    {
        return $this->hasmany(Uts::class, 'siswa_id');
    }

    // Relasi ke UAS
    public function uas()
    {
        return $this->hasMany(Uas::class, 'siswa_id');
    }

    // Relasi ke Catatan Pembina
    // public function catatanPembina()
    // {
    //     return $this->hasOne(CatatanPembina::class, 'siswa_id');
    // }

    public function ekskul()
    {
        return $this->belongsToMany(
            Ekskul::class,
            'siswa_ekskul',
            'siswa_id',
            'ekskul_id'
        )->withPivot('tingkat_keterampilan','tingkat_partisipasi')->withTimestamps();
    }

    public function catatanPembina()
    {
        return $this->hasMany(CatatanPembina::class, 'siswa_id');
    }
}


