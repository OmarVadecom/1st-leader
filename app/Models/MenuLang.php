<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuLang extends Model
{
    protected $table = 'menus_lang';
    protected $fillable = [
        'menu_id', 'lang', 'title', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu_id');
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
}
