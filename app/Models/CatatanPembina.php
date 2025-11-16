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
        'potensi',
        'rekomendasi_pengembangan',
     ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'pembina_id');
    }

    public function penilaian()
    {
        return $this->hasOneThrough(
            PenilaianEkskul::class,  // model tujuan
            SiswaEkskul::class,      // model perantara
            'siswa_id',              // foreign key di SiswaEkskul
            'siswa_ekskul_id',       // foreign key di PenilaianEkskul
            'siswa_id',              // local key di CatatanPembina
            'id'                     // local key di SiswaEkskul
        )->where('ekskul_id', $this->pembina?->ekskul_id ?? 0);
    }

}