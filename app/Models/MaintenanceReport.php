<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceReport extends Model
{
    protected $table = 'maintenance_report';
    protected $fillable = [
        'customer_id', 'maintenance_id', 'status', 'start', 'end', 'type', 'tech_rate', 'tech_report',
        'recommends_rate', 'recommends', 'products_id', 'parts_id', 'quantities', 'prices', 'discounts',
        'dreba', 'totals', 'maintenance_cost','addon_disc', 'status_report', 'status_warranty'
    ];

    public function Maintenance()
    {
        return $this->belongsTo('App\Models\Maintenance', 'maintenance_id');
    }

    public function sell()
    {
        return $this->hasOne('App\Models\Sells', 'maintenance_id');

    }
    public function delivery()
    {
        return $this->hasOne('App\Models\Delivery', 'maintenance_id');

    }
}
