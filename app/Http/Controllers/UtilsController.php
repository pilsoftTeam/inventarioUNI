<?php

namespace App\Http\Controllers;

use App\InfoInventario;
use App\ItemsInventario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class UtilsController extends Controller
{
    public function detailedDump()
    {
        Excel::create('DumpDetallado -- ' . Carbon::now(), function ($excel) {
            $infoInventario = InfoInventario::with('getCampus', 'getCustodio', 'getItems')->get();

            foreach ($infoInventario as $key => $item) {
                $excel->sheet($item->getCampus['campus'], function ($sheet) use ($key, $item) {
                    $titles = [
                        'A1' => 'Sede : ',
                        'A2' => 'Campus :',
                        'A3' => 'Numero Pabellon : ',
                        'A4' => 'Numero Piso : ',
                        'A5' => 'Codigo Ubicacion : ',
                        'A6' => 'Folio : ',
                    ];
                    $values = [
                        'B1' => $item->getCampus->getSede['sede'],
                        'B2' => $item->getCampus['campus'],
                        'B3' => 'N °' . $item->numeroPabellon,
                        'B4' => 'N °' . $item->numeroPiso,
                        'B5' => 'N °' . $item->codigoUbicacion,
                        'B6' => 'N °' . $item->id
                    ];

                    foreach ($titles as $index => $title) {
                        $sheet->cell($index, function ($cell) use ($index, $title) {
                            $cell->setValue($title);
                        });
                    }
                    foreach ($values as $index => $value) {
                        $sheet->cell($index, function ($cell) use ($index, $value) {
                            $cell->setValue($value);
                        });
                    }

                    $sheet->row(8, ['Items de inventario']);

                    $sheet->row(10, [
                        'Codigo Anterior',
                        'Codigo Nuevo',
                        'Descripcion',
                        'Marca',
                        'Modelo',
                        'Numero de Serie',
                        'Estado',
                        'Comentario'
                    ]);
                    foreach ($item->getItems as $index => $getItem) {
                        $sheet->row(12 + $index, [
                            $getItem['codigoAnterior'],
                            $getItem['codigoNuevo'],
                            $getItem['descripcion'],
                            $getItem['marca'],
                            $getItem['modelo'],
                            $getItem['numeroSerie'],
                            $getItem['estado'],
                            $getItem['comentario']
                        ]);
                    }


                });
            }
        })->download('xlsx');

    }

    public function bulkDump()
    {
        Excel::create('DumpTotal', function ($excel) {
            $excel->sheet('DUMP', function ($sheet) {
                $bulkData = ItemsInventario::with('getInfo')->get();
                $sheet->row(1, array(
                    'Folio',
                    'Sede',
                    'Campus',
                    'Pabellon',
                    'Piso',
                    'Codigo de ubicacion',
                    '',
                    'Codigo Anterior',
                    'Codigo Nuevo',
                    'Descripcion',
                    'Marca',
                    'Modelo',
                    'Numero de serie',
                    'Estado',
                    'Comentario',
                    'Creado el ',
                    'Modificado el ',
                ));
                foreach ($bulkData as $index => $bulk) {
                    $sheet->row($index + 3, [
                        $bulk->getInfo->id,
                        $bulk->getInfo->getCampus->getSede->sede,
                        $bulk->getInfo->getCampus->campus,
                        $bulk->getInfo->numeroPabellon,
                        $bulk->getInfo->numeroPiso,
                        $bulk->getInfo->codigoUbicacion,
                        '',
                        $bulk->codigoAnterior,
                        $bulk->codigoNuevo,
                        $bulk->descripcion,
                        $bulk->marca,
                        $bulk->modelo,
                        $bulk->numeroSerie,
                        $bulk->estado,
                        $bulk->comentario,
                        $bulk->created_at,
                        $bulk->updated_at,
                    ]);
                }
            });
        })->download('xlsx');
    }


}
