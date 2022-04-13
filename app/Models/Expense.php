<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';
    protected $fillable = [
        'name', 'code', 'category_id'
    ];

    protected $appends = ['code'];

    public function getCodeAttribute()
    {
        return 'EXP-' . substr($this['created_at']->format('Y'), -2);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ExpenseCategory', 'category_id');
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

}
