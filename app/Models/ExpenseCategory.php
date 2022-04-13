<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table = 'expensecategory';
    protected $fillable = [
        'name', 'code'
    ];

    public function expenses()
    {
        return $this->hasMany('App\Models\expense', 'category_id');
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

}
