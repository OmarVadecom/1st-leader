<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'parent_id','category_id','name', 'name_en', 'general_resp', 'personal_resp', 'work', 'email', 'phonenumber', 'phonenumbertwo', 'fax', 'country', 'work', 'city', 'reg_city', 'region', 'street', 'lat', 'lng','resp_name_sponsor','work_sponsor','resp_tele_sponsor','resp_phone_sponsor','resp_email_sponsor','resp_tele_red_sponsor'
    ];

    public function visits()
    {
        return $this->hasMany('App\Models\Visits', 'customer_id');
    }
    public function customers()
    {
        return $this->hasMany('App\Models\Customers', 'parent_id');
    }
    public function getCodeAttribute()
    {
        $id = str_pad($this->id, 4, '0', STR_PAD_LEFT);
        $id = 'ACF-' . $id;
        return $id;
    }

}
