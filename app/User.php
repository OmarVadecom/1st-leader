<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isAdmin','type','username', 'role_id', 'branch'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
       'isAdmin' => 'boolean'
   ];

   public function role()
   {
      return $this->hasOne('App\Models\Role\Role', 'id', 'role_id');
   }

   public function visits()
   {
       return $this->hasMany('App\Models\Visits', 'user_id');
   }

   public function messages_to()
   {
       return $this->hasMany('App\User', 'mesg_to');
   }

   public function messages_from()
   {
       return $this->hasMany('App\User', 'mesg_from');
   }

   /**
    * Make passowrd encripted
    *
    * @var $val
    * @return void
    */
    public function setPasswordAttribute($val){
      $this->attributes['password'] = bcrypt($val);
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->attributes['name']);
    }

    public function getUserTypeAttribute()
    {
        return $this->attributes['isAdmin'] ? trans('admin.admin') : trans('admin.user');
    }

    public function getRoleNameAttribute()
    {
        return isset($this->role->lang()->name) ? $this->role->lang()->name : '-';
    }

    /**
    * Make Status boolean value
    *
    * @var $val
    * @return void
    */
    public function setStateAttribute($val){
      $this->attributes['state'] = (boolean) $val;
    }

    public function setUsernameAttribute($val){
      $this->attributes['username'] =  str_random(6);
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
