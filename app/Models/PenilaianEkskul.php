<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianEkskul extends Model
{
    protected $table = 'penilaian_ekskul';
    protected $fillable = [
        'siswa_ekskul_id',
        'tingkat_partisipasi',
        'tingkat_keterampilan',
        'catatan'
    ];

    public function anggota()
    {
        return $this->belongsTo(SiswaEkskul::class, 'siswa_ekskul_id');
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class);
    }

}
