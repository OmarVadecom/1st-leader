<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartsProductsOut extends Model
{
    protected $table = 'parts_products_out';
    protected $fillable = [
    	'part_id','code','company','wakel','image'
    ];



    public function part()
    {
        return $this->belongsTo('App\Models\Products', 'part_id');

    }

    
}


?>