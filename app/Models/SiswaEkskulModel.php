<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

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

}
