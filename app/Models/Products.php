<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use SoftDeletes;
    protected $table = 'product';
    protected $fillable = [
        'category_id', 'maintenance', 'code','secret_num','type', 'insurance', 'name', 'name_en', 'image', 'origin_id', 'country_id', 'brand_id', 'description','title_description','img_description', 'color', 'weight', 'saf_weight', 'dimension', 'album', 'quantity', 'price', 'price_unit', 'price_vat', 'group_pro', 'group_status', 'group_quantities', 'unit_1', 'unit_2', 'unit_3', 'unit_default', 'unit_2_con', 'unit_3_con', 'attachments','attachment_names','attachment_links','attachment_status', 'charts','hidden','main_spec_img'
    ];

    public function getFullNameAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    public function purchase(): BelongsToMany
    {
        return $this->belongsToMany(Purchase::class, 'products_purchase');
    }
    public function parts()
    {
        return $this->hasMany('App\Models\PartsProducts', 'product_id');
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
        public function sections()
    {
        return $this->hasMany('App\Models\ProductSection', 'product_id');
    }
    public function addon()
    {
        return $this->hasMany('App\Models\ProductAddons', 'product_id');

    }
    public function market()
    {
        return $this->hasMany('App\Models\ProductMarket', 'product_id');
    }

    public function supplies()
    {
        return $this->hasMany('App\Models\Supply', 'product_id');
    }
}
