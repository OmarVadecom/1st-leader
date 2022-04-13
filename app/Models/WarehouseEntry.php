<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseEntry extends Model
{
    protected $table = 'warehouses_entries';
    protected $fillable=['date','time','notes','user_id'];

    public function supplies()
    {
        return $this->hasMany('App\Models\Supply', 'entry_id');
    }
}
