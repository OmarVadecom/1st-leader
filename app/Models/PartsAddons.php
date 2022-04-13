<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartsAddons extends Model
{
    protected $table = 'parts_addons';
    protected $fillable = [
    	'part_id','units','units_barcode','units_cons','unit_default','prices','prices_discounts','prices_targets','gifts_ids','gifts_quantities','gifts_for'
    ];



    public function product()
    {
        return $this->belongsTo('App\Models\Products', 'part_id');

    }

    
}


?>