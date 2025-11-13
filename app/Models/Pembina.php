<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    protected $table = 'pembina';
    protected $fillable = ['user_id', 'nama', 'ekskul_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id');
    }

    public function catatan()
    {
        return $this->hasMany(CatatanPembina::class, 'pembina_id');
    }
}

