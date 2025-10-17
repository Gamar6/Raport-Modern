<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Models\CatatanPembina;

class SiswaEkskulModel extends Model
{
    use HasFactory;

    protected $table = 'siswa_ekskul';
    protected $fillable = ['siswa_id', 'ekskul_id', 'tingkat', 'partisipasi'];

    // Relasi dengan model Ekskul
    public function ekstrakurikuler()
    {
        return $this->belongsTo(EkskulModel::class, 'ekskul_id');
    }

    // Relasi dengan model User (Siswa)
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    // Relasi dengan CatatanPembina (banyak catatan untuk 1 siswa-ekskul)
    public function catatanPembina()
    {
        return $this->hasMany(CatatanPembina::class, 'siswa_ekskul_id');
    }

    public function penilaianPotensi()
{
    return $this->hasOne(PenilaianPotensi::class, 'siswa_id', 'siswa_id')
                ->where('ekskul_id', $this->ekskul_id);
}


}


