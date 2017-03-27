<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventarioController extends Controller
{
    public function manageFiles(Request $request)
    {
        /*
         * Orden de las carpetas segun el numero
         * sede/campus/pabellon/piso/codigoUbicacion
         * $i = inventario
         * Se opto por un nombre corto para no dañar el layout del editor
         */
        $i = json_decode($request->dataInventario);
        $ruta = $i->sede . '/' . $i->campus . '/' . $i->pabellon . '/' . $i->piso . '/' . $i->codigoUbicacion . '/' . $i->index;
        Storage::makeDirectory($ruta);
        $fileName = $request->file->getClientOriginalName();
        $request->file->storeAs($ruta, $fileName);

        return response()->json($ruta, 201);
    }


    public function deleteFiles(Request $request)
    {
        $i = $request->all();
        $ruta = $i['sede'] . '/' . $i['campus'] . '/' . $i['pabellon'] . '/' . $i['piso'] . '/' . $i['codigoUbicacion'] . '/' . $i['index'];
        Storage::delete($ruta . '/' . $i['filename']);
        return response()->json([], 200);
    }

    public function endInventario(Request $request)
    {
        return response()->json($request->all(), 201);
    }

}
