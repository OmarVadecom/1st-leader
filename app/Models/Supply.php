<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $table = 'product_warehouses';
    protected $fillable = [
    	'date','warehouse_id','product_id','code_type','quantity','price','cost', 'stock_id','addon', 'addon_perc','entry_id','transport_id', 'ware_to'
    ];



    public function product()
    {
        if ($this->code_type  != 'ES' && $this->code_type  != 'EA'){
        return $this->belongsTo('App\Models\Products', 'product_id');
        }else{
         return $this->belongsTo('App\Models\Parts', 'product_id');
        }
    }
        public function part()
    {
        return $this->belongsTo('App\Models\Parts', 'product_id');

    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse', 'warehouse_id');

    }
    public function warehouseto()
    {
        return $this->belongsTo('App\Models\Warehouse', 'ware_to');
    }
    public function transport()
    {
        return $this->belongsTo('App\Models\ProductTransport', 'transport_id');
    }

    public function warehouseEntry()
    {
        return $this->belongsTo('App\Models\WarehouseEntry', 'entry_id');
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

}


?>
