<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaEkskul extends Model
{
    protected $table = 'siswa_ekskul';
    protected $fillable = ['siswa_id', 'ekskul_id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // public function ekskul()
    // {
    //     return $this->belongsTo(Ekskul::class);
    // }

    public function penilaian()
    {
        return $this->hasMany(PenilaianEkskul::class, 'siswa_ekskul_id');
    }

    public function siswaEkskul()
    {
        return $this->hasMany(SiswaEkskul::class, 'siswa_id');
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id');
    }

 

}
