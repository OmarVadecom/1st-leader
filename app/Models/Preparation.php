<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preparation extends Model
{
    protected $table = 'preparations';
    protected $fillable = [
        'time', 'customer_id', 'price_id', 'date', 'number', 'duration', 'representative_name', 'representative_phone_number', 'preparator_name', 'type', 'status', 'progress', 'preparation_notes', 'deliverer_name', 'deliverer_phone_number', 'delivery_type', 'delivery_notes', 'recipient_name', 'reciept_city', 'reciept_region', 'reciept_street', 'recipient_phone_number', 'reciept_notes', 'reciept_lat', 'reciept_lng', 'notes', 'declaration',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\PrepareProduct', 'prepare_id');
    }
    public function delivery()
    {
        return $this->hasOne('App\Models\Delivery', 'prepare_id');
    }
    public function priceoffer()
    {
        return $this->belongsTo('App\Models\PriceOffer', 'price_id');
    }

    public function parts()
    {
        return $this->belongsToMany('App\Models\Parts', 'preparation_parts', 'preparation_id', 'part_id')->withPivot('warehouse_id', 'unit', 'quantity', 'prepared', 'pended');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customers', 'customer_id');
    }

    public function getPreparestatusAttribute()
    {
        $pre = PrepareProduct::where('prepare_id', $this->id)->where('remains', 0)->count();
        if ($pre == count($this->products)) {
            return "<span style='color:green'>تم تحضيرها</span>";
        } elseif ($pre == 0) {
            return "<span style='color:red'>لم يتم تحضيرها</span>";
        } else {
            return "<span style='color:#c77800'>لم يكتمل تحضيرها</span>";
        }
    }

    public function getCodeAttribute()
    {
        $id = str_pad($this->id, 4, '0', STR_PAD_LEFT);
        $id = 'PRP-' . $id;
        return $id;
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
