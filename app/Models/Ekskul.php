<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table = 'ekskul';

    protected $fillable = ['namaEkskul', 'pembina_id'];

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'pembina_id');
    }

    // Ekskul punya banyak siswa (melalui pivot)
    public function anggota()
    {
        return $this->belongsToMany(Siswa::class, 'ekskul_siswa', 'ekskul_id', 'siswa_id');
    }

    // Catatan pembina terkait ekskul
    public function catatan()
    {
        return $this->hasMany(CatatanPembina::class, 'ekskul_id');
    }
}
