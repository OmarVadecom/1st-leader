<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $fillable = [
        'name', 'name_en', 'phone', 'email', 'address', 'job', 'type',
    ];

    public function getCodeAttribute(): string
    {
        return 'SUP-' . str_pad($this['id'], 4, '0', STR_PAD_LEFT);
    }

    public function purchasesPricesOffers(): HasMany
    {
        return $this->hasMany(PurchasePriceOffer::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
