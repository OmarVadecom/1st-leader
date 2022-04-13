<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'region_id', 'name', 'postal_code',
    ];

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id');
    }
}
