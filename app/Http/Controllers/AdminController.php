<?php

namespace App\Http\Controllers;

use App\InfoInventario;
use App\ItemsInventario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {


        $per_page = isset($request->per_page) ? $request->per_page : 15;
        // Searching method
        // You can use a full-text-search Algolia, Elastic Search, etc ..
        $searching = $request->search;
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

    public function getItems($id)
    {
        $items = ItemsInventario::where('idInfoInventario', $id)->get();

        return response()->json($items, 200);
    }
}
