<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sanadat extends Model
{
    use SoftDeletes;
    protected $table = 'sanadat';
    protected $fillable = [
        'type', 'ex_type', 'p_type', 'box_id', 'expense_id', 'cl_sup_id', 'acc_type', 'cost', 'date', 'notes', 'time', 'sell_id'
    ];

    public function expense()
    {
        return $this->belongsTo('App\Models\Expense', 'expense_id');
    }

    public function box()
    {
        return $this->belongsTo('App\Models\MoneyBox', 'box_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Customers', 'cl_sup_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'cl_sup_id');
    }

    public function gettype(): string
    {
        if (isset($this->ex_type)) {
            if ($this->ex_type === 1) {
                return "نقدي";
            }

            if ($this->ex_type === 2) {
                return "عهده";
            }

            return "بنكي - تحويل";
        }

        if (isset($this->p_type) && $this->p_type === 1) {
            return "اجل - نقدي";
        }

        return "بنكي - تحويل";
    }


    public function get_sanad_name()
    {
        if (isset($this->expense_id)) {
            return $this->expense->name;
        } else {
            if ($this->acc_type == 'client') {
                return $this->client->name;
            } else {
                return $this->supplier->name;

            }
        }
    }

    public function getCodeAttribute()
    {
        $id = str_pad($this->id, 4, '0', STR_PAD_LEFT);
        $id = 'SAN-' . $id;
        return $id;
    }

    public function dailyTransaction(): MorphMany
    {
        return $this->morphMany(DailyTransaction::class, 'dailyTransaction');
    }

    public function sell(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sells::class, 'sell_id')->withTrashed();
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
