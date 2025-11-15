<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruKelas extends Model
{
    protected $table = 'guru_kelas';
    protected $fillable = [
        'id',
        'guru_id',
        'kelas_id',
        'created_at',
        'updated_at'
    ];
}
