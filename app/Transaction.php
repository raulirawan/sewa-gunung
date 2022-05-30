<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';


    public function ketuaKelompok()
    {
        return $this->belongsTo(KetuaKelompok::class, 'ketua_kelompok_id','id');
    }

        public function site()
    {
        return $this->belongsTo(Site::class, 'site_id','id');
    }

}
