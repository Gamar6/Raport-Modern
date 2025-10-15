<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    

    protected $fillable = [
        'username',
        'password',
        'nama',
        'role',
        'foto',
    ];
    protected $hidden = [
        'password',
    ];

    public function siswa()
    {
    return $this->hasOne(Siswa::class);
    }

    public function kelasYangDiampu()
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id'); 
    }


    public function nilaiDiberikan()
    {
        return $this->hasMany(Nilai::class, 'guru_id');
    }
    public function guru()
    {
        return $this->hasOne(Guru::class);
    }



}
