<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = [
    	'name', 'email', 'address', 'phone', 'title', 'message', 'status','id_number','nationality'
    ];

    public function getShowAttribute()
    {
        return $this->attributes['status'] == 1 ? trans('admin.read') : trans('admin.unread');
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
