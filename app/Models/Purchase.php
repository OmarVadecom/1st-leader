<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    protected $table = 'purchases';
    protected $fillable = [
        'price_offer_id', 'box_id', 'user_id', 'supplier_id', 'supplier_name', 'products_ids', 'parts_ids',
        'quantities', 'discounts', 'dreba', 'time', 'date', 'notes', 'declaration', 'addon_discount',
        'total_money', 'total_vat', 'prices', 'type'
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

    public function dailyTransaction(): MorphMany
    {
        return $this->morphMany(DailyTransaction::class, 'dailyTransaction');
    }

    public function purchasePriceOffer(): HasOne
    {
        return $this->hasOne(PurchasePriceOffer::class, 'price_offer_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Products::class, 'products_purchase');
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}


