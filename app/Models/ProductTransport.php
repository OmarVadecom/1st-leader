<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTransport extends Model
{
    protected $table = 'product_transport';
    protected $fillable = [
        'products_id', 'codes_type', 'quantities', 'users_id', 'ware_from', 'ware_to', 'date', 'time', 'representative_name', 'representative_phone_number', 'preparator_name', 'type', 'doc_num', 'preparation_notes', 'deliverer_name', 'deliverer_phone_number', 'delivery_type', 'deliverer_identity', 'delivery_car_num', 'deliverer_doc_num', 'delivery_notes', 'recipient_name', 'reciept_city', 'reciept_region', 'reciept_street', 'recipient_phone_number', 'reciept_notes', 'notes', 'declaration',
    ];

    public function getCodeAttribute()
    {
        $id = str_pad($this->id, 4, '0', STR_PAD_LEFT);
        $id = 'TR-' . $id;
        return $id;
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

}
