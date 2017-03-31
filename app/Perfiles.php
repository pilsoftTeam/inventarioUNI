<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    protected $table = 'perfiles';

    public function getUsers()
    {
        return $this->hasMany('App\User', 'id', 'idUsuario');
    }

    public function getRoles()
    {
        return $this->belongsTo('App\Roles', 'idRol', 'id');
    }


}
