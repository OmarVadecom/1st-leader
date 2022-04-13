<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrepareProduct extends Model
{
    protected $table = 'prepare_products';
    protected $fillable = [
        'prepare_id', 'product_id', 'quantity', 'prepared', 'remains', 'status', 'warehouse_id', 'user_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Products', 'product_id');
    }

    public function prepare()
    {
        return $this->belongsToMany('App\Models\Parts', 'prepare_id');
    }

}
