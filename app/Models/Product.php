<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $fillable = [
        'image', 'status', 'featured', 'barcode', 'views', 'quantity', 'slug', 'product_category_id'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    public function productsLang()
    {
        return $this->hasMany('App\Models\ProductLang', 'product_id');
    }

    public function lang()
    {
        return $this->productsLang()->where('lang', getCurrentLocale())->first();
    }

    public function langWith($lang)
    {
        return $this->productsLang()->where('lang', $lang)->first();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id');
    }

    public function purchase()
    {
        return $this->hasMany('App\Models\Purchase', 'product_id');
    }
        public function sections()
    {
        return $this->hasMany('App\Models\ProductSection', 'product_id');
    }


    public function getPhotoArrayAttribute()
    {
        return json_decode($this->attributes['image']);
    }

    public function getCategoryIdAttribute()
    {
        return $this->product_category_id;
    }

    public function getPhotoAttribute()
    {
        $image = $this->photo_array;
        $photo = '';
        if ($image != null && $image != [] && isset($image[0]) && isset($image[0]->image)) {
            $photo = $image[0]->image;
        }
        return $photo;
    }

    public function getImagePathAttribute()
    {
        $photo = $this->photo;
        return $photo == null ? '' : url($photo);
    }

    public function getAltPhotoAttribute($key = null)
    {
        $key = $key == null ? getCurrentLocale() : $key;
        $image = $this->photo_array;
        $alt = $this->name;
        if ($image != null && $image != [] && isset($image[0]) && isset($image[0]->title->$key)) {
            $alt = $image[0]->title->$key;
        }
        return $alt;
    }

    public function getNameAttribute()
    {
        return isset($this->lang()->title) ? $this->lang()->title : '';
    }

    public function getContentAttribute()
    {
        return isset($this->lang()->content) ? $this->lang()->content : '';
    }

    public function getKeysAttribute()
    {
        return isset($this->lang()->keywords) ? $this->lang()->keywords : getSettings('site_keys');
    }

    public function getLimitDescAttribute()
    {
        return isset($this->lang()->content) ? str_limit(strip_tags($this->lang()->content), 75) : '';
    }

    public function getDescripAttribute()
    {
        return isset($this->lang()->description) ? $this->lang()->description : getSettings('site_desc');
    }

    public function getUrlAttribute()
    {
        return isset($this->slug) ? route('site.products.single', $this->slug) : '#';
    }

    public function getPathAttribute()
    {
        return isset($this->slug) ? $this->slug : '#';
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
    public function setStatusAttribute($val)
    {
        $this->attributes['status'] = (boolean) $val;
    }

    public function setFeaturedAttribute($val)
    {
        $this->attributes['featured'] = (boolean) $val;
    }

    public function setImageAttribute($val)
    {
        $this->attributes['image'] = json_encode($val);
    }
}
