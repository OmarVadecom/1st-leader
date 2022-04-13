<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
    	'mesg_from', 'mesg_to', 'message'
    ];


    public function User_From()
    {
        return $this->belongsTo('App\User', 'mesg_from');
    }

    public function User_To()
    {
        return $this->belongsTo('App\User', 'mesg_to');
    }

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }
}

