<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSection extends Model
{
    protected $table = 'product_sections';
    protected $fillable = [
    'product_id','section_id','name','description'
    ];
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

}


?>