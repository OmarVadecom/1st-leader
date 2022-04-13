<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMarket extends Model
{
    protected $table = 'product_market_details';
    protected $fillable = [
    	'supplier','date','sales_man','phone','price','employee'
    ];



    public function product()
    {
        return $this->belongsTo('App\Models\Products', 'product_id');

    }

    
}


?>