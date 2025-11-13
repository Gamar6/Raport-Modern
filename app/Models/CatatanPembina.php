<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanPembina extends Model
{
    protected $table = 'catatan_pembina';
    protected $fillable = [
        'siswa_id',
        'pembina_id',
        'namaAnggota',
        'catatan',
        'tingkat_partisipasi',
        'tingkat_keterampilan',
        'potensi',
        'rekomendasi_pengembangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'pembina_id');
    }
}