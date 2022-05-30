<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KuotaGunung extends Model
{
    protected $table = 'kuota_gunung';

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id','id');
    }


}
