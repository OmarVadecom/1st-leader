<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = [
        'link', 'target', 'link_method','icon', 'parent_id', 'ordering', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function menusLang()
    {
        return $this->hasMany('App\Models\MenuLang', 'menu_id');
    }

    public function lang()
    {
        return $this->menusLang()->where('lang', getCurrentLocale())->first();
    }

    public function langWith($lang)
    {
        return $this->menusLang()->where('lang', $lang)->first();
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }

    public function parents()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id', 'id');
    }

    public function getHasParentAttribute()
    {
        return $this->parents->count();
    }

    public function getNameAttribute()
    {
        return isset($this->lang()->title) ? $this->lang()->title : '';
    }

    public function getShowAttribute()
    {
        return $this->attributes['status'] == 1 ? trans('admin.active') : trans('admin.inactive');
    }

    public function getUrlAttribute()
    {
        $add = $this->link == '/' ? '' : $this->link;
        return linkRef($this->link_method) . $add;
    }

    public static function langPluck($array = null)
    {
        $parents = self::join('menus_lang as withLang', 'withLang.menu_id', '=', 'menus.id')
                    ->where('menus.parent_id', null);
                    if($array != null){
                    $parents = $parents->whereNotIn('menus.id', $array);
                    }
                    $parents = $parents->where('withLang.lang', getCurrentLocale())
                    ->pluck('withLang.title', 'menus.id');
        return $parents;
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


    public function hasSubMenus()
   {
       if (!$this->parents()) $this->parents()->get();

       return $this->parents->count() != 0;
   }


}
