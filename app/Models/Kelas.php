<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id'); // ✅ kolom benar
    }

    public function wali()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id'); // ✅ kolom benar
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

}

