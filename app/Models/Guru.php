<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['user_id', 'nip'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Kelas yang dia jadi wali
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'waliKelas_id');
    }
}
