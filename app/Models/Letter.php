<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $table = 'letters';
    protected $fillable = [
        'center_name', 'code', 'segl_num', 'filename',
    ];

}
