<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';
    protected $fillable = [
        'time', 'customer_id', 'maintenance_id', 'price_id', 'prepare_id', 'date', 'representative_name', 'representative_phone_number', 'preparator_name', 'type', 'doc_num', 'preparation_notes', 'deliverer_name', 'deliverer_phone_number', 'delivery_type', 'deliverer_identity', 'delivery_car_num', 'deliverer_doc_num', 'delivery_notes', 'recipient_name', 'reciept_city', 'reciept_region', 'reciept_street', 'recipient_phone_number', 'reciept_notes', 'reciept_lat', 'reciept_lng', 'notes', 'declaration',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\DeliveryProduct', 'delivery_id');
    }
    public function priceoffer()
    {
        return $this->belongsTo('App\Models\PriceOffer', 'price_id');
    }
    public function prepare()
    {
        return $this->belongsTo('App\Models\Preparation', 'prepare_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customers', 'customer_id');
    }

    public function getDeliverystatusAttribute()
    {
        $pre = DeliveryProduct::where('delivery_id', $this->id)->where('remains', 0)->count();
        if ($pre == count($this->products)) {
            return "<span style='color:green'>تم تسليمها</span>";
        } elseif ($pre == 0) {
            return "<span style='color:red'>لم يتم تسليمها</span>";
        } else {
            return "<span style='color:#c77800'>لم يكتمل تسليمها</span>";
        }
    }
    public function getCodeAttribute(): string
    {
        $id = str_pad($this['id'], 4, '0', STR_PAD_LEFT);

        return 'DLV-' . substr($this['created_at']->format('Y'), -2) . '-' . $id;
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
