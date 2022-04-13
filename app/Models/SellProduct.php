<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellProduct extends Model
{
    protected $table = 'sells_product';
    protected $fillable = [
        'warehouse_id','sell_id', 'product_id', 'part_id', 'price', 'quantity', 'type',
    ];
    public function sell()
    {
        return $this->belongsTo('App\Models\Sells', 'sell_id');
    }

}
