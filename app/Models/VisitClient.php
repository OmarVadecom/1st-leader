<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitClient extends Model
{
    protected $table = 'visits_client';
    protected $fillable = [
        'visit_id','mainrate','segl_type','client_type','resp_name','client_phone','client_decision','client_serious','client_ready','client_con','client_clients','client_ins','locationrate','location_type','services','location_status','client_location_status','goods_available','cleaning','equip_interest','distance','workrate','work_num','nationality','worker_rate','worker_qualify'
    ];


}
    ?>