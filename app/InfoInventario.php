<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoInventario extends Model
{
    protected $table = 'info_inventarios';

    public function getCampus()
    {
        return $this->hasOne('App\Campus', 'id', 'idCampus')->with('getSede');
    }

    public function getCustodio()
    {
        return $this->hasOne('App\Custodios', 'id', 'idCustodio');
    }

    public function getItems()
    {
        return $this->hasMany('App\ItemsInventario', 'idInfoInventario', 'id');
    }
}
