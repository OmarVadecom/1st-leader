<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitDelegate extends Model
{
    protected $table = 'visits_delegate';
    protected $fillable = [
        'visit_id','delegatestars','delegateclient','con_way','del_notes','del_visit','del_visit_reason','managervisit','managerdelegate','sales_notes','sales_recommend'
     ];













}
    ?>