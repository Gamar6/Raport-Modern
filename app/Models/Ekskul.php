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

    // Relasi ke Anggota Siswa
    public function anggota()
    {
        return $this->belongsTo(Siswa::class, 'anggota_id');
    }
}
