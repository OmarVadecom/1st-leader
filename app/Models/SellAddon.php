<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellAddon extends Model
{
    protected $table = 'sells_invoice_addons';
    
    protected $fillable = [
    	'invoice_id','title','cost'
    ];



    public function invoice()
    {
        return $this->belongsTo('App\Models\SellInvoice', 'invoice_id');
    }



}
?>