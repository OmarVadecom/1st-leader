<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCategory extends Model
{
    protected $table = 'customers_category';
    protected $fillable = [
    	'name','code'
    ];

    public function customers()
    {
        return $this->hasMany('App\Models\Customers', 'category_id');
    }


}


?>