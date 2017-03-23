<?php

namespace App\Http\Controllers;

use App\Custodios;
use Illuminate\Http\Request;

class CustodiosController extends Controller
{
    public function index()
    {
        return response()->json(Custodios::all(), 200);
    }

    public function create(Request $request)
    {
        $c = new Custodios();
        $c->nombre = $request->nombre;
        $c->rut = $request->rut;
        $c->unidad = $request->unidad;
        $c->nombreDependencia = $request->dependencia;
        $c->save();
        return response()->json(201);
    }
}
