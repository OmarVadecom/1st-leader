<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    protected $fillable = [
        'name', 'brandcode', 'image', 'sort', 'country_id',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

}
