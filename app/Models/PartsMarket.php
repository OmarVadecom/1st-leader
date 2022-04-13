<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartsMarket extends Model
{
    protected $table = 'parts_market_details';
    protected $fillable = [
    	'supplier','date','sales_man','phone','price','employee'
    ];



    public function product()
    {
        return $this->belongsTo('App\Models\Products', 'part_id');

    }

    
}


?>