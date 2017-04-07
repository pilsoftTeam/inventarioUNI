<?php

namespace App\Http\Controllers;

use App\Campus;
use App\Custodios;
use App\InfoInventario;
use App\ItemsInventario;
use App\Sedes;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $per_page = isset($request->per_page) ? $request->per_page : 15;
        $data = InfoInventario::with('getCampus', 'getCustodio', 'getRevisor')->paginate($per_page);

        return [
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ],
            'data' => $data->items()
        ];
    }

    public function search(Request $request)
    {
        $per_page = isset($request->per_page) ? $request->per_page : 15;
        $data = InfoInventario::where('folio', $request->search)
            ->with('getCampus', 'getCustodio', 'getRevisor')
            ->paginate($per_page);

        return [
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ],
            'data' => $data->items()
        ];
    }

    public function getItems($id)
    {
        $items = ItemsInventario::where('idInfoInventario', $id)->get();

        return response()->json($items, 200);
    }

    public function editFilesFromInventory(Request $request)
    {
        $i = json_decode($request->dataInventario);
        $fileName = $request->file->getClientOriginalName();
        $request->file->storeAs($i, $fileName);
        return response()->json($i, 200);
    }

    public function deleteFiles(Request $request)
    {
        Storage::delete($request->ruta . '/' . $request->filename);
        return response()->json($request->ruta, 200);
    }


    public function saveInventario(Request $request)
    {

        foreach ($request->items as $index => $item) {

            try {
                if (!empty($item['id'])) {
                    ItemsInventario::where('id', $item['id'])->update([
                        'codigoAnterior' => $item['codigoAnterior'],
                        'codigoNuevo' => $item['codigoNuevo'],
                        'descripcion' => $item['descripcion'],
                        'marca' => $item['marca'],
                        'modelo' => $item['modelo'],
                        'numeroSerie' => $item['numeroSerie'],
                        'estado' => $item['estado'],
                        'comentario' => $item['comentario'],
                    ]);
                } else {
                    $items = new ItemsInventario();
                    $items->idInfoInventario = $request->data['id'];
                    $items->codigoAnterior = $item['codigoAnterior'];
                    $items->codigoNuevo = $item['codigoNuevo'];
                    $items->descripcion = $item['descripcion'];
                    $items->marca = $item['marca'];
                    $items->modelo = $item['modelo'];
                    $items->numeroSerie = $item['numeroSerie'];
                    $items->rutaImagen = $item['rutaArchivo'];
                    $items->estado = $item['estado'];
                    $items->comentario = $item['comentario'];
                    $items->save();
                }


                /*$items = new ItemsInventario();
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
                $items->save();*/
            } catch (QueryException $ex) {
                /*ItemsInventario::where('idInfoInventario', $idInfoInventario)->delete();
                InfoInventario::where('id', $idInfoInventario)->delete();*/
                return response()->json($ex, 500);
            }

        }


        return response()->json([], 201);

    }

    public function getFiles(Request $request)
    {
        $files = Storage::files($request->ruta);

        $base = [];


        foreach ($files as $file) {
            array_push($base, Image::make(storage_path() . '/app/' . $file)->encode('data-url'));
        }


        return response()->json($base, 200);
    }


    public function getFileFromEdition(Request $request)
    {
        Excel::load('storage\\app\\frames\\frame.xlsx', function ($file) use ($request) {

            $file->sheet('Formulario', function ($sheet) use ($request) {
                $idSede = Campus::where('id', $request->data['idCampus'])->value('idSede');
                $sede = Sedes::where('id', $idSede)->value('sede');
                $campus = Campus::where('id', $request->data['idCampus'])->value('campus');
                $custodio = Custodios::where('id', $request->data['idCustodio'])->first();
                $nombreRevisor = Auth::user()->name;

                $sheet->cell('D14', function ($cell) use ($sede) {
                    $cell->setValue($sede);
                });
                $sheet->cell('D15', function ($cell) use ($sede, $campus) {
                    $cell->setValue($sede . ' - ' . $campus);
                });
                $sheet->cell('D16', function ($cell) use ($sede, $campus, $request) {
                    $cell->setValue($sede . ' - ' . $campus . '- P' . $request->data['numeroPabellon']);
                });
                $sheet->cell('D17', function ($cell) use ($request) {
                    $cell->setValue($request->data['numeroPiso']);
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
                        $cell->setValue($item['codigoAnterior']);
                    });
                    $sheet->cell('C' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['codigoNuevo']);
                    });
                    $sheet->cell('D' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['descripcion']);
                    });
                    $sheet->cell('E' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['marca']);
                    });
                    $sheet->cell('F' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['modelo']);
                    });
                    $sheet->cell('G' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['numeroSerie']);
                    });
                    $sheet->cell('I' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['estado']);
                    });
                    $sheet->cell('J' . ($index + 28), function ($cell) use ($item) {
                        $cell->setValue($item['comentario']);
                    });
                }
            });

        })->download('xlsx');
    }

}
