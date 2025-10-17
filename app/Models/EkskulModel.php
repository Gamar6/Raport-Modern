<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EkskulModel extends Model
{
    use HasFactory;

    protected $table = 'ekskul';
    protected $fillable = ['nama_ekskul', 'deskripsi'];

    // Relasi dengan model SiswaEkskulModel
    public function siswaEkstrakurikuler()
    {
        return $this->hasMany(SiswaEkskulModel::class, 'ekskul_id');
    }

    // Relasi dengan model User (Pembina)
    public function pembina()
    {
        return $this->belongsTo(User::class, 'pembina_id');
    }
}

