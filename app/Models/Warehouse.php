<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse';
    protected $fillable = [
    	'name' , 'stock_id'
    ];

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }


}


?>
