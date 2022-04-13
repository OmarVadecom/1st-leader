<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartsProducts extends Model
{
    protected $table = 'parts_products';
    protected $fillable = [
    	'part_id','product_id'
    ];



    public function product()
    {
        return $this->belongsTo('App\Models\Products', 'product_id');

    }
    public function part()
    {
        return $this->belongsTo('App\Models\parts', 'part_id');

    }
    
}


?>