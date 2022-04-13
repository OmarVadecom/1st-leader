<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAddons extends Model
{
    protected $table = 'product_addons';
    protected $fillable = [
    	'units','units_barcode','units_cons','unit_default','prices','prices_discounts','prices_targets','gifts_ids','gifts_quantities','gifts_for','product_id'
    ];



    public function product()
    {
        return $this->belongsTo('App\Models\Products', 'product_id');

    }

    
}


?>