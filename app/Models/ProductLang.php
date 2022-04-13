<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLang extends Model
{
     protected $table = 'products_lang';
    protected $fillable = [
    	'product_id', 'lang', 'title', 'status', 'featured', 'slug', 'content', 'description', 'keywords'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    public function product()
    {
    	return $this->belongsTo('App\Models\Product', 'product_id');
    }

     /**
    * Make Status boolean value
    *
    * @var $val
    * @return void
    */
    public function setStatusAttribute($val){
      $this->attributes['status'] = (boolean) $val;
    }

    public function setFeaturedAttribute($val){
      $this->attributes['featured'] = (boolean) $val;
    }
}
