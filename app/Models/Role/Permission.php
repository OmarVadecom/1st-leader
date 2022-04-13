<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
    	'for', 'name', 'status'
    ];
}
