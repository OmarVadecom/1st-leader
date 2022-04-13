<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use softDeletes;

    protected $table = 'warranties';
    protected $fillable = [
        'user_id', 'product_id', 'date_create_warranty', 'tech_report',
        'problem', 'recommend', 'notes', 'attachments', 'part_id',
        'type'
    ];

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

    public function getCodeAttribute(): string
    {
        return 'WAR-' . substr($this['created_at']->format('Y'), -2);
    }

    public function product() {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function part() {
        return $this->belongsTo(Parts::class, 'part_id');
    }
}
