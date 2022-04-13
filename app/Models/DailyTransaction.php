<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyTransaction extends Model
{
    use SoftDeletes;
    protected $table = 'daily_transactions';
    protected $fillable = [
    	'total_money','total_vat', 'model_id', 'model_type', 'box_id', 'supplier_id',
        'customer_id', 'user_id'
    ];

    public function box(): BelongsTo
    {
        return $this->belongsTo(MoneyBox::class);
    }

    public function dailyTransaction(): MorphTo
    {
        return $this->morphTo()->withTrashed();
    }
}


