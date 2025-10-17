<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanPembina extends Model
{
    protected $table = 'catatan_pembina';
    protected $fillable = ['siswa_ekskul_id', 'pembina_id', 'alasan', 'rekomendasi'];

    public function siswaEkskul()
    {
        return $this->belongsTo(SiswaEkskulModel::class, 'siswa_ekskul_id');
    }

    public function pembina()
    {
        return $this->belongsTo(User::class, 'pembina_id');
    }
}
