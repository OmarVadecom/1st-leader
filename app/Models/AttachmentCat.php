<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmentCat extends Model
{
    protected $table = 'attachmentscat';
    protected $fillable = [
        'name', 'image',
    ];

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', session('loginYear') ?? gmdate('Y'));
    }

}
