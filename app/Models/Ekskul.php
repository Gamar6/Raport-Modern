<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table = 'ekskul';
    protected $fillable = ['nama', 'pembina_id', 'anggota_id'];

    // Relasi ke Pembina
    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'pembina_id');
    }

    //Relasi ke ekskul
    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id');
    }
    
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_ekskul')
                    ->withPivot('tingkat_keterampilan', 'tingkat_partisipasi')
                    ->withTimestamps();
    }


}
