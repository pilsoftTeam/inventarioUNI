<?php

namespace App\Http\Controllers;

use App\InfoInventario;
use App\Sedes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RevisorController extends Controller
{
    public function getInformacion()
    {
        $informacion = Sedes::with('getCampus')->get();
        $sedesHechas = InfoInventario::all();
        return response()->json([$informacion, $sedesHechas], 200);
    }

    public function validarInventario(Request $request)
    {
        $validacion = InfoInventario::where('idCampus', $request->campus)
            ->where('numeroPabellon', $request->pabellon)
            ->where('numeroPiso', $request->piso)->first();
        return response()->json($validacion, 200);

    }

    public function deleteFailed(Request $request)
    {
        $items = $request->all();
        foreach ($items as $item) {
            Storage::delete(json_decode($item['ruta']) . '/' . $item['filename']);
        }
        return response()->json([], 200);
    }
}
