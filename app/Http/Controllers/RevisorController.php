<?php

namespace App\Http\Controllers;

use App\Sedes;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    public function getInformacion()
    {
        $informacion = Sedes::with('getCampus')->get();

        return response()->json($informacion, 200);
    }
}
