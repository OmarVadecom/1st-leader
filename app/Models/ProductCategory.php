<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
     protected $table = 'product_categories';
    protected $fillable = [
    	'slug', 'status','title','featured'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    // public function productsLang()
    // {
    // 	return $this->hasMany('App\Models\ProductCategoryLang', 'product_category_id');
    // }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'product_category_id');
    }

    public function limitedProducts()
    {
        return $this->products()->orderBy('created_at', 'desc')->take(8)->get();
    }

    public function StatusProducts($status = 1, $paginate = 16)
    {
         return $this->products()->whereStatus($status)->orderBy('created_at', 'desc')->paginate($paginate);
    }

    public function FeaturedLimitedProducts($limit = 2)
    {
        return $this->products()->where('featured', 1)->orderBy('created_at', 'desc')->take($limit)->get();
    }

    public function lang()
    {
    	return $this->productsLang()->where('lang', getCurrentLocale())->first();
    }

    public function langWith($lang)
    {
    	return $this->productsLang()->where('lang', $lang)->first();
    }



    public function getShowAttribute()
    {
        return $this->attributes['status'] == 1 ? trans('admin.active') : trans('admin.inactive');
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

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

}
