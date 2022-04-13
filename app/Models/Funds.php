<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    protected $table = 'funds';
    protected $fillable = [
        'price_id', 'client_id', 'money', 'date_from', 'date_to', 'type',
        'bank', 'bank_num', 'note', 'status', 'reading_status'
    ];

    public function price()
    {
        return $this->belongsTo('App\Models\PriceOffer', 'price_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customers', 'client_id');
    }
    public function getCodeAttribute(): string
    {
        return 'INV-' . substr($this['created_at']->format('Y'), -2);
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}
