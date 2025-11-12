<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    protected $table = 'pembina';

    protected $fillable = ['user_id', 'namaPembina']; // tambahkan sesuai kolommu

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke ekskul
    public function ekskuls()
    {
        return $this->hasMany(Ekskul::class, 'pembina_id');
    }

    // Relasi ke siswa melalui ekskul
    public function siswas()
    {
        return $this->hasManyThrough(
            Siswa::class,
            Ekskul::class,
            'pembina_id', // FK di ekskul ke pembina
            'id',         // PK di siswa
            'id',         // PK di pembina
            'anggota_id'  // FK di ekskul ke siswa (kalau kolom ini masih dipakai)
        );
    }

    // Relasi ke catatan pembina
    public function catatan()
    {
        return $this->hasMany(CatatanPembina::class, 'pembina_id');
    }
}
