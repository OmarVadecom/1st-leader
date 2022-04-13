<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class MoneyBox extends Model
{
    protected $table = 'money_boxes';
    protected $fillable = [
    	'name','code'
    ];

    public function dailyTransactions(): HasMany
    {
        return $this->hasMany(DailyTransaction::class);
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
