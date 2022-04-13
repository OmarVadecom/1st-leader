<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceOffer extends Model
{
    protected $table = 'price_offers';
    protected $fillable = [
       'box_id','parent', 'user_id', 'visit_id', 'customer_id', 'products_id', 'parts_id', 'quantities', 'prices', 'discounts', 'dreba', 'type', 'inv_type', 'down_payment_perc', 'down_payment', 'prepare', 'prepare_notes', 'delivery', 'license_image', 'driver_image', 'status', 'install', 'install_date', 'install_files', 'notes', 'totals', 'prepare'
        , 'time', 'date', 'offer_number', 'offer_duration', 'declaration', 'offer_details', 'client_details', 'addon_discount', 'addon_notes','status', 'supplier', 'supplier_comp','pur_type','supplier_id','addon_disc','attachments'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customers', 'customer_id');
    }

    public function visit()
    {
        return $this->belongsTo('App\Models\Visits', 'visit_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function invoice()
    {
        return $this->hasMany('App\Models\SellInvoice', 'price_id');
    }
    public function getPaddedIdAttribute()
    {
        return 'QUT-' . substr($this->created_at->format('Y'), -2) . '-' . str_pad($this->attributes['id'], 4, '0', STR_PAD_LEFT);
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\PriceOffer', 'parent');
    }
    public function offers()
    {
        return $this->hasMany('App\Models\PriceOffer', 'parent');
    }
    public function funds()
    {
        return $this->hasMany('App\Models\Funds', 'price_id');
    }

    public function getCodeAttribute()
    {
        return 'QUT-' . substr($this['created_at']->format('Y'), -2);
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
