<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{

    protected $table = 'visits';
    protected $fillable = [
    	'user_id', 'customer_id', 'products_in', 'quantities_in','products_out','quantities_out','status','card_image','notes','inform','lat','lng','date','hour'
    ];

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }


    public function customer()
    {
        return $this->belongsTo('App\Models\Customers', 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function priceoffers()
    {
        return $this->hasMany('App\Models\PriceOffer', 'visit_id');
    }

    public function clientrate(){
        return $this->hasOne('App\Models\VisitClient', 'visit_id');
    }

    public function delegaterate(){
        return $this->hasOne('App\Models\VisitDelegate', 'visit_id');
    }

    public function market(){
        return $this->hasOne('App\Models\VisitMarket', 'visit_id');
    }

}


