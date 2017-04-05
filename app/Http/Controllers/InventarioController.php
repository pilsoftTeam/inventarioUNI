<?php

namespace App\Http\Controllers;

use App\Campus;
use App\Custodios;
use App\InfoInventario;
use App\ItemsInventario;
use App\Sedes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class InventarioController extends Controller
{

    public function manageFilesFromInventory(Request $request)
    {
        /*
         * Orden de las carpetas segun el numero
         * sede/campus/pabellon/piso/codigoUbicacion
         * $i = inventario
         * Se opto por un nombre corto para no dañar el layout del editor
         */
        $i = json_decode($request->dataInventario);
        $ruta = 'inventarios/' . $i->sede . '/' . $i->campus . '/' . $i->pabellon . '/' . $i->piso . '/' . $i->codigoUbicacion . '/' . $i->index;
        Storage::makeDirectory($ruta);
        $fileName = $request->file->getClientOriginalName();
        $request->file->storeAs($ruta, $fileName);

        return response()->json($ruta, 201);
    }

    public function manageFilesFromIndex(Request $request)
    {
        $i = json_decode($request->dataInventario);
        $ruta = 'layouts/' . $i->sede . '/' . $i->campus . '/' . $i->pabellon . '/' . $i->piso . '/' . $i->codigoUbicacion;
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
        $last = InfoInventario::orderBy('id', 'desc')->first();

        if ($last['id'] == 1) {
            $last['id'] = 2;
        } elseif (!$last) {
            $last['id'] = 1;
        }
        $infoInventario = new InfoInventario();
        $infoInventario->folio = sprintf('%012d', $last['id']);
        $infoInventario->idRevisor = Auth::user()->id;
        $infoInventario->idCampus = $request->data['campus'];
        $infoInventario->idCustodio = $request->data['custodio'][0]['id'];
        $infoInventario->numeroPabellon = $request->data['pabellon'];
        $infoInventario->numeroPiso = $request->data['piso'];
        $infoInventario->codigoUbicacion = $request->data['codigoUbicacion'];
        $infoInventario->rutaImagenLayout = $request->data['rutaImagenLayout'];
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

    public function getFile(Request $request)
    {

        Excel::load('storage\\app\\frames\\frame.xlsx', function ($file) use ($request) {

            $file->sheet('Formulario', function ($sheet) use ($request) {
                $idSede = Campus::where('id', $request->data['campus'])->value('idSede');
                $sede = Sedes::where('id', $idSede)->value('sede');
                $campus = Campus::where('id', $request->data['campus'])->value('campus');
                $custodio = Custodios::where('id', $request->data['custodio'][0]['id'])->first();
                $nombreRevisor = Auth::user()->name;

                $sheet->cell('D14', function ($cell) use ($sede) {
                    $cell->setValue($sede);
                });
                $sheet->cell('D15', function ($cell) use ($sede, $campus) {
                    $cell->setValue($sede . ' - ' . $campus);
                });
                $sheet->cell('D16', function ($cell) use ($sede, $campus, $request) {
                    $cell->setValue($sede . ' - ' . $campus . '- P' . $request->data['pabellon']);
                });
                $sheet->cell('D17', function ($cell) use ($request) {
                    $cell->setValue($request->data['piso']);
                });
                $sheet->cell('D18', function ($cell) use ($request) {
                    $cell->setValue($request->data['codigoUbicacion']);
                });
                $sheet->cell('G14', function ($cell) use ($custodio) {
                    $cell->setValue($custodio->nombre);
                });
                $sheet->cell('G15', function ($cell) use ($custodio) {
                    $cell->setValue($custodio->rut);
                });
                $sheet->cell('G16', function ($cell) use ($custodio) {
                    $cell->setValue($custodio->unidad);
                });
                $sheet->cell('G17', function ($cell) use ($custodio) {
                    $cell->setValue($custodio->nombreDependencia);
                });
                $sheet->cell('A22', function ($cell) use ($custodio) {
                    $cell->setValue(date('d/m/Y', time()));
                });
                $sheet->cell('D22', function ($cell) use ($nombreRevisor) {
                    $cell->setValue($nombreRevisor);
                });


                foreach ($request->items as $index => $item) {

                    $sheet->cell('B' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['codigo']['anterior']);
                    });
                    $sheet->cell('C' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['codigo']['nuevo']);
                    });
                    $sheet->cell('D' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['detalles']['descripcion']);
                    });
                    $sheet->cell('E' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['detalles']['marca']);
                    });
                    $sheet->cell('F' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['detalles']['modelo']);
                    });
                    $sheet->cell('G' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['detalles']['numeroSerie']);
                    });
                    $sheet->cell('I' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['estado']);
                    });
                    $sheet->cell('J' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['comentario']);
                    });
                }


            });

        })->store('xlsx', storage_path('excel/exports'));

        //return response()->json($request->all(), 200);
    }

}
