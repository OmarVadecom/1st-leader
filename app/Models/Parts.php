<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    protected $table = 'parts';
    protected $fillable = [
        'category_id', 'products_id', 'parts_id', 'code', 'code_type', 'type', 'insurance', 'name', 'name_en', 'image', 'origin_id', 'country_id', 'brand_id', 'description', 'color', 'weight', 'saf_weight', 'dimension', 'album', 'quantity', 'price', 'price_unit', 'price_vat', 'group_pro', 'group_status', 'group_quantities', 'unit_1', 'unit_2', 'unit_3', 'unit_default', 'unit_2_con', 'unit_3_con', 'attachments', 'charts', 'related_ids','maintenance','secret_num','hidden'
    ];

    public function purchase()
    {
        return $this->hasMany('App\Models\Purchase', 'product_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brands', 'brand_id');
    }
    public function origin()
    {
        return $this->belongsTo('App\Models\Country', 'origin_id');
    }

    public function addon()
    {
        return $this->hasMany('App\Models\PartsAddons', 'part_id');

    }
    public function market()
    {
        return $this->hasMany('App\Models\PartsMarket', 'part_id');
    }

    public function productsout()
    {
        return $this->hasMany('App\Models\PartsProductsOut', 'part_id');
    }

    public function productsin()
    {
        return $this->hasMany('App\Models\PartsProducts', 'part_id');
    }
    public function supplies()
    {
        return $this->hasMany('App\Models\Supply', 'product_id');
    }
}
