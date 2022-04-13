<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    protected $table = 'purchase_invoice';
    protected $fillable = [
    	'company','name','serial_num','products_id', 'quantities','prices','total','general_total','images','details'
    ];

}


