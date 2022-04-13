<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Sells extends Model
{
    use SoftDeletes;
    protected $table = 'sells';

    protected $fillable = [
        'id','box_id','user_id', 'delivery_id', 'maintenance_id','main_type', 'customer_id', 'products_id',
        'parts_id', 'quantities', 'prices', 'discounts', 'dreba', 'totals', 'type', 'notes', 'time', 'date',
        'warehouse_id','status_insert','addon_disc', 'total_money', 'total_vat', 'invoice_type',
        'down_payment', 'branch'
    ];

    protected $appends = ['code'];

    public function client()
    {
        return $this->belongsTo('App\Models\Customers', 'customer_id');
    }
    public function maintenance()
    {
        return $this->belongsTo('App\Models\Maintenance', 'maintenance_id');
    }


    public function getCodeAttribute()
    {
        if($this['branch'] !== null) {

            if($this['invoice_type'] === 'deferred') {

                if($this['main_type'] === 2 && $this['type'] === 2) {
                    return 'INV-OJB-cd-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }

                if($this['main_type'] === null && $this['type'] === 2) {
                    return 'INV-WK-cd-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }

                if($this['main_type'] === 4 && $this['type'] === 4) {
                    return 'INV-OVT-cd-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }

                if($this['main_type'] === 5 && $this['type'] === 5) {
                    return 'INV-CAL-cd-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }

                if($this['main_type'] === null && $this['type'] === 0) {
                    return 'INV-SH-cd-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }

            } else {

                if($this['main_type'] === 2 && $this['type'] === 2) {
                    return 'INV-OJB-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }

                if(($this['main_type'] === null || $this['main_type'] === 1) && $this['type'] === 2) {
                    return 'INV-WK-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }

                if($this['main_type'] === 4 && $this['type'] === 4) {
                    return 'INV-OVT-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }

                if($this['main_type'] === 5 && $this['type'] === 5) {
                    return 'INV-CAL-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }

                if($this['main_type'] === null && $this['type'] === 0) {
                    return 'INV-SH-' . substr($this['created_at']->format('Y'), -2) . '-' . $this['branch'];
                }
            }

        } else {

            if($this['invoice_type'] === 'deferred') {

                if($this['main_type'] === 2 && $this['type'] === 2) {
                    return 'INV-OJB-cd-' . substr($this['created_at']->format('Y'), -2);
                }

                if($this['main_type'] === null && $this['type'] === 2) {
                    return 'INV-WK-cd-' . substr($this['created_at']->format('Y'), -2);
                }

                if($this['main_type'] === 4 && $this['type'] === 4) {
                    return 'INV-OVT-cd-' . substr($this['created_at']->format('Y'), -2);
                }

                if($this['main_type'] === 5 && $this['type'] === 5) {
                    return 'INV-CAL-cd-' . substr($this['created_at']->format('Y'), -2);
                }

                if($this['main_type'] === null && $this['type'] === 0) {
                    return 'INV-SH-cd-' . substr($this['created_at']->format('Y'), -2);
                }

            } else {

                if($this['main_type'] === 2 && $this['type'] === 2) {
                    return 'INV-OJB-' . substr($this['created_at']->format('Y'), -2);
                }

                if($this['main_type'] === null && $this['type'] === 2) {
                    return 'INV-WK-' . substr($this['created_at']->format('Y'), -2);
                }

                if($this['main_type'] === 4 && $this['type'] === 4) {
                    return 'INV-OVT-' . substr($this['created_at']->format('Y'), -2);
                }

                if($this['main_type'] === 5 && $this['type'] === 5) {
                    return 'INV-CAL-' . substr($this['created_at']->format('Y'), -2);
                }

                if($this['main_type'] === null && $this['type'] === 0) {
                    return 'INV-SH-' . substr($this['created_at']->format('Y'), -2);
                }

            }

        }

        return 'INV-' . substr($this['created_at']->format('Y'), -2);
    }


    public function getTotalmoneyAttribute()
    {
        $total = 0;
        $total_before_vat = 0;
        $total_quantitiy_price=0;
        $total_vat=0;
        $quantities = explode(',', $this->quantities);
        $prices = explode(',', $this->prices);
        $discounts = explode(',', $this->discounts);
        foreach($prices as $key=>$price){
                $subtotal = round((float)$quantities[$key] * (float)$price, 2);
                $total_quantitiy_price += $subtotal;
                $totalsecond = $subtotal * ((float)$discounts[$key] / 100);
                $totalbeforevat = $subtotal - $totalsecond;
                $total_before_vat += $totalbeforevat;
                $totalvatval = $totalbeforevat * (getSettings('site_vat_value') / 100);
                $total_vat += $totalvatval;
                $totalvat = round((float)$totalbeforevat + (float)$totalvatval, 2);
                $total += $totalvat;
        }
        if (isset($this->addon_disc) && $this->addon_disc != "" && $this->addon_disc != 0) {
            $total_before_vat = $total_before_vat - (float)$this->addon_disc;
            $total_vat = $total_before_vat * (getSettings('site_vat_value') / 100);
            $total = $total_before_vat + $total_vat;
        }
        return number_format(round($total,2));
    }

    public function dailyTransaction(): MorphMany
    {
        return $this->morphMany(DailyTransaction::class, 'dailyTransaction');
    }

    public function sand(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Sanadat::class, 'sell_id');
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

}
