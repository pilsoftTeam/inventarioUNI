<?php

namespace App\Http\Controllers;

use App\InfoInventario;
use App\ItemsInventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $infoInventario = new InfoInventario();
        $infoInventario->idRevisor = Auth::user()->id;
        $infoInventario->idCampus = $request->data['campus'];
        $infoInventario->idCustodio = $request->data['custodio'][0]['id'];
        $infoInventario->numeroPabellon = $request->data['pabellon'];
        $infoInventario->numeroPiso = $request->data['piso'];
        $infoInventario->codigoUbicacion = $request->data['codigoUbicacion'];
        $infoInventario->save();
        $idInfoInventario = $infoInventario->id;

        foreach ($request->items as $index => $item) {
            $items = new ItemsInventario();
            $items->idInfoInventario = $idInfoInventario;
            $items->codigoAnterior = $item['codigo']['anterior'];
            $items->codigoNuevo = $item['codigo']['nuevo'];
            $items->descripcion = $item['detalles']['descripcion'];
            $items->marca = $item['detalles']['marca'];
            $items->modelo = $item['detalles']['modelo'];
            $items->numeroSerie = $item['detalles']['numeroSerie'];
            $items->rutaImagen = $item['rutaArchivo'];
            $items->estado = $item['estado'];
            $items->comentario = $item['comentario'];
            $items->save();

        }
        return response()->json([], 201);
    }

}
