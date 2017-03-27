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

    public function search($rut)
    {
        $rutCustodio = Custodios::where('rut', $rut)->get();
        return response()->json($rutCustodio, 200);
    }

    public function create(Request $request)
    {
        $c = new Custodios();
        $c->nombre = $request->nombre;
        $c->rut = $request->rut;
        $c->unidad = $request->unidad;
        $c->nombreDependencia = $request->nombreDependencia;
        $c->save();
        return response()->json([], 201);
    }

    public function edit(Request $request)
    {
        Custodios::where('id', $request->id)->update([
            'rut' => $request->rut,
            'nombre' => $request->nombre,
            'unidad' => $request->unidad,
            'nombreDependencia' => $request->nombreDependencia
        ]);
        return response()->json([], 200);
    }

    public function delete($id)
    {
        Custodios::destroy($id);
        return response()->json([], 200);
    }
}
