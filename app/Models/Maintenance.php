<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';
    protected $fillable = [
        'date', 'time', 'serial_num', 'attachments', 'notes', 'quantity', 'product_id','part_id', 'parts_id', 'parts_num', 'parts_status','parts_op_status', 'parts_cleaning', 'type', 'name', 'client_id', 'comp_id', 'status', 'type', 'op_status', 'cleaning', 'problem_rate', 'problem_description', 'delivery_rate', 'delivery_description', 'cost', 'maintenance','del_attachments','del_notes','main_type','main_code'
    ];

    public function product()
    {
        if(isset($this->product_id)){
        return $this->belongsTo('App\Models\Products', 'product_id');
        }else{
         return $this->belongsTo('App\Models\Parts', 'part_id');
        }
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Customers', 'client_id');
    }
    public function complaint()
    {
        return $this->belongsTo('App\Models\Complaint', 'comp_id');
    }
    public function getCodeAttribute(): string
    {
        if($this['main_type'] === 2){
            return 'OJB-' . substr($this['created_at']->format('Y'), -2);
        }
        if($this['main_type'] === 4){
            return 'OVT-' . substr($this['created_at']->format('Y'), -2);
        }
        if($this['main_type'] === 5){
            return 'CAL-' . substr($this['created_at']->format('Y'), -2);
        }
        return 'MNT-' . substr($this['created_at']->format('Y'), -2);
    }

    public function report()
    {
        return $this->hasOne('App\Models\MaintenanceReport', 'maintenance_id');

    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
