<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $table = 'campus';

    public function getSede()
    {
        return $this->belongsTo('App\Sedes', 'idSede', 'id');
    }
}
