<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = ['user_id', 'namaSiswa', 'kelas_id'];

    public function ekskuls()
    {
        return $this->belongsToMany(Ekskul::class, 'ekskul_siswa', 'siswa_id', 'ekskul_id');
    }

    public function catatan()
    {
        return $this->hasMany(CatatanPembina::class, 'siswa_id');
    }
}
