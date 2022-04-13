<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $table = 'langs';
    protected $fillable = ['name', 'code', 'flag', 'image', 'status'];

    public function getNameAttribute($val)
    {
        return ucfirst($val);
    }
}
