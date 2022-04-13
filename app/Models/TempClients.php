<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempClients extends Model
{
    protected $table = 'temp_clients';
    protected $fillable = [
        'product_id', 'code', 'type', 'year', 'image', 'bui_name', 'segl_name', 'center_name', 'postal_code', 'region', 'old_region', 'city', 'maintainace_cat', 'worker_num', 'phone', 'fax', 'supervisor', 'mobile', 'email', 'old_email', 'website', 'old_bui', 'old_segl_num', 'old_center', 'old_responsable', 'old_mobile', 'greeting', 'title', 'address', 'password', 'truecaller_id', 'truecaller_pass', 'anydesk_id', 'status', 'technical', 'technical_num', 'old_city', 'old_address', 'old_phone', 'old_technical', 'old_technical_num', 'responsable', 'lat', 'lng',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Products', 'product_id');
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

}
