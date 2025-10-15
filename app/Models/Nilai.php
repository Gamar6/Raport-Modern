<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';


    protected $fillable = [
    'siswa_id',
    'guru_id',
    'mapel',
    'jenis_nilai',
    'nilai',
    'catatan',
    'tanggal_input',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}


