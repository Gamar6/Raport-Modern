<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanPembina extends Model
{
    protected $table = 'catatan_pembina';
    protected $fillable = [
        'siswa_id', 'namaAnggota', 'tingkat_partisipasi',
        'tingkat_keterampilan', 'catatan', 'potensi', 'rekomendasi_pengembangan'
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
