<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryProduct extends Model
{
    protected $table = 'delivery_products';
    protected $fillable = [
        'delivery_id', 'product_id', 'code_type', 'quantity', 'delivered', 'remains', 'status', 'warehouse_id', 'user_id',
    ];

    public function product()
    {
        if ($this->code_type == 'EA' || $this->code_type == 'ES') {
            return $this->belongsTo('App\Models\Parts', 'product_id');
        } else {
            return $this->belongsTo('App\Models\Products', 'product_id');
        }
    }

    public function delivery()
    {
        return $this->belongsToMany('App\Models\Delivery', 'delivery_id');
    }

}
