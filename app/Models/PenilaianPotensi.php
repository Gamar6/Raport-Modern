<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianPotensi extends Model
{
    use HasFactory;

    protected $table = 'penilaian_potensi';
    protected $fillable = [
        'siswa_id',
        'ekskul_id',
        'pembina_id',
        'kategori_potensi',
        'alasan',
        'rekomendasi'
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function ekskul()
    {
        return $this->belongsTo(EkskulModel::class, 'ekskul_id');
    }

    public function pembina()
    {
        return $this->belongsTo(User::class, 'pembina_id');
    }
}
