<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gifts extends Model
{
    protected $table = 'gifts';
    protected $fillable = [
    	'name','image'
    ];

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }



}


?>
