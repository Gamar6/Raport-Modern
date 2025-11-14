<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'users';
    protected $fillable = ['user_id', 'username',];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
