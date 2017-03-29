<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sedes extends Model
{
    protected $table = 'sedes';

    public function getCampus()
    {
        return $this->hasMany('App\Campus', 'idSede', 'id');
    }

}
