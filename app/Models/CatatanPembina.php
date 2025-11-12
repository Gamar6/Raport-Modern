<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanPembina extends Model
{
    protected $table = 'catatan_pembina';

    protected $fillable = [
        'pembina_id',
        'siswa_id',
        'ekskul_id',
        'catatan',
        'tingkat_partisipasi',
        'tingkat_keterampilan',
        'potensi',
        'rekomendasi_pengembangan',
    ];


    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id');
    }
}
