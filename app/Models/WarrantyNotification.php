<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarrantyNotification extends Model
{
    protected $table = 'warranties_notifications';
    protected $fillable = [
        'model_type', 'code', 'reading_status', 'product_id', 'part_id'
    ];

    public function product() {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function part() {
        return $this->belongsTo(Parts::class, 'part_id');
    }
}
