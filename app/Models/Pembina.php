<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    protected $table = 'pembina';
    protected $fillable = ['user_id', 'nip'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Ekskul yang dia bimbing
    public function ekskul()
    {
        return $this->hasMany(Ekskul::class, 'pembina_id');
    }
}
