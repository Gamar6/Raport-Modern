<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table = 'ekskul';
    protected $fillable = ['nama', 'pembina_id', 'anggota_id'];

    // Relasi ke Pembina
public function siswa()
{
    return $this->belongsToMany(Siswa::class, 'siswa_ekskul');
}

public function anggota()
{
    return $this->hasMany(SiswaEkskul::class);
}

public function penilaian()
{
    return $this->hasMany(PenilaianEkskul::class, 'siswa_ekskul_id');
}

public function pembina()
{
    return $this->belongsTo(Pembina::class, 'pembina_id');
}


    

}
