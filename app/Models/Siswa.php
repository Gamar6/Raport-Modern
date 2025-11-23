<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['user_id', 'kelas_id', 'uts_id', 'uas_id', 'nis', 'tingkat', 'namaSiswa', 'jenis_kelamin'];

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
    
    public function ekskuls()
    {
        return $this->belongsToMany(Ekskul::class, 'siswa_ekskul');
    }

    // 🔹 Relasi ke Catatan Pembina (bisa banyak)
    public function catatanPembina()
    {
        return $this->hasMany(CatatanPembina::class, 'siswa_id');
    }

    public function siswaEkskul()
    {
        return $this->hasMany(SiswaEkskul::class, 'siswa_id');
    }
    
    public function penilaianEkskul()
    {
        return $this->hasManyThrough(
            PenilaianEkskul::class,
            SiswaEkskul::class,
            'siswa_id',
            'siswa_ekskul_id',
            'id',
            'id'
        );
    }

}




