<?php

namespace App\Http\Controllers;

use App\InfoInventario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class UtilsController extends Controller
{
    public function DBDump()
    {
        Excel::create('Acumulado -- ' . Carbon::now(), function ($excel) {
            $infoInventario = InfoInventario::with('getCampus', 'getCustodio', 'getItems')->get();

            foreach ($infoInventario as $key => $item) {
                $excel->sheet($item->getCampus['campus'], function ($sheet) use ($key, $item) {
                    $titles = [
                        'A1' => 'Sede : ',
                        'A2' => 'Campus :',
                        'A3' => 'Numero Pabellon : ',
                        'A4' => 'Numero Piso : ',
                        'A5' => 'Codigo Ubicacion : '
                    ];
                    $values = [
                        'B1' => $item->getCampus->getSede['sede'],
                        'B2' => $item->getCampus['campus'],
                        'B3' => 'N °' . $item->numeroPabellon,
                        'B4' => 'N °' . $item->numeroPiso,
                        'B5' => 'N °' . $item->codigoUbicacion
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

                    $sheet->row(7, ['Items de inventario']);

                    $sheet->row(9, [
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
                        $sheet->row(11 + $index, [
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
}
