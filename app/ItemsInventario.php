<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsInventario extends Model
{
    protected $table = 'items_inventarios';

    public function getInfo()
    {
        return $this->belongsTo('App\InfoInventario', 'idInfoInventario', 'id')
            ->with('getCampus', 'getCustodio');
    }
}
