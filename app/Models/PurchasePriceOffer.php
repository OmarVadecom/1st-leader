<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class PurchasePriceOffer extends Model
{
    protected $table = 'purchases_prices_offers';
    protected $fillable = [
       'user_id', 'supplier_id', 'supplier_name', 'products_ids', 'parts_ids', 'prices', 'discounts',
        'dreba', 'date', 'time', 'notes', 'offer_duration', 'declaration', 'addon_discount',
        'total_money', 'total_vat', 'status', 'quantities', 'type'
    ];

    protected $appends = ['code'];

    public function getCodeAttribute(): string
    {
        return 'QUT-' . substr($this['created_at']->format('Y'), -2);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchase(): HasOne
    {
        return $this->hasOne(Purchase::class);
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
