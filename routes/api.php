<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['auth:api']], function () {

    //Revisor
    Route::get('/get/sedes/informacion', 'RevisorController@getInformacion');

    //Inventario
    Route::post('/file/upload', 'InventarioController@manageFilesFromInventory');
    Route::post('/file/layout/upload', 'InventarioController@manageFilesFromIndex');
    Route::post('/file/remove', 'InventarioController@deleteFiles');
    Route::post('/upload/inventario', 'InventarioController@endInventario');

    //Custodios
    Route::get('/get/custodios', 'CustodiosController@index');
    Route::get('/get/custodio/{rut}', 'CustodiosController@search');
    Route::post('/create/custodio', 'CustodiosController@create');
    Route::put('/edit/custodio', 'CustodiosController@edit');
    Route::delete('/delete/custodio/{id}', 'CustodiosController@delete');

    //Validacion

    Route::get('/validar/codigo/ubicacion/{ubicacion}', 'RevisorController@searchCodigoUbicacion');

    //Utils

    //Usuarios

    Route::get('/get/usuarios', 'UserController@index');
    Route::get('/get/roles', 'UserController@getRoles');
    Route::post('/add/user', 'UserController@save');

});