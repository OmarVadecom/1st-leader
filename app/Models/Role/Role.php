<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
    	'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function rolesLang()
    {
    	return $this->hasMany('App\Models\Role\RoleLang', 'role_id');
    }

    public function permissions()
    {
    	return $this->belongsToMany('App\Models\Role\Permission', 'role_permission', 'role_id', 'permission_id');
    }

    public function lang()
    {
    	return $this->rolesLang()->where('lang', getCurrentLocale())->first();
    }

    public function langWith($lang)
    {
    	return $this->rolesLang()->where('lang', $lang)->first();
    }

    public function langPluck()
    {
        return $this->join('roles_lang as withLang', 'withLang.role_id', '=', 'roles.id')
                    ->where('withLang.lang', getCurrentLocale())
                    ->pluck('withLang.name', 'roles.id');
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
}
