<?php

namespace App\Http\Controllers;

use App\InfoInventario;
use App\Sedes;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    public function getInformacion()
    {
        $informacion = Sedes::with('getCampus')->get();

        return response()->json($informacion, 200);
    }

    public function searchCodigoUbicacion($ubicacion)
    {
        $v = InfoInventario::where('codigoUbicacion', $ubicacion)->first();
        return response()->json($v, 200);
    }
}
