<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianAktivitas extends Model
{
    use HasFactory;

    protected $table = 'penilaian_aktivitas';
    protected $fillable = [
        'siswa_id',
        'ekskul_id',
        'pembina_id',
        'partisipasi',
        'tingkat_keterampilan',
        'catatan'
    ];

    // Relasi dengan User (Siswa)
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    // Relasi dengan Ekskul
    public function ekskul()
    {
        return $this->belongsTo(EkskulModel::class, 'ekskul_id');
    }

    // Relasi dengan Pembina
    public function pembina()
    {
        return $this->belongsTo(User::class, 'pembina_id');
    }
}
