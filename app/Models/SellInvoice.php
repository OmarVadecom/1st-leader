<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellInvoice extends Model
{
    protected $table = 'sells_invoice';
    protected $fillable = [
    	'id','price_id', 'cost','offer_price','remains','notes','total_bands','total'
    ];


    public function priceoffer()
    {
    	return $this->belongsTo('App\Models\PriceOffer', 'price_id');
    }



    public function bands()
    {
        return $this->hasMany('App\Models\SellAddon', 'invoice_id');
    }
}


