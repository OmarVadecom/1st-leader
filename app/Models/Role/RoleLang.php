<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;

class RoleLang extends Model
{
    protected $table = 'roles_lang';
    protected $fillable = [
    	'role_id', 'lang', 'name', 'comment'
    ];

    public function role()
    {
    	return $this->belongsTo('App\Models\Role\Role', 'role_id');
    }
}
