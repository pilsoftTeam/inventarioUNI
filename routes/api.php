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


    Route::post('/get/frame/excel', 'InventarioController@getFile');
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

    Route::post('/validar/inventario', 'RevisorController@validarInventario');
    Route::post('/delete/failed/inventory', 'RevisorController@deleteFailed');

    //Utils

    //Revision inventarios

    Route::get('/get/inventarios', 'AdminController@index');
    Route::get('/search/inventarios', 'AdminController@search');
    Route::get('/get/items/inventario/{id}', 'AdminController@getItems');


    Route::post('/file/edit/upload', 'AdminController@editFilesFromInventory');
    Route::post('/file/remove/upload', 'AdminController@deleteFiles');
    Route::post('/file/get/excel', 'AdminController@getFileFromEdition');
    Route::post('/save/updated/inventario', 'AdminController@saveInventario');
    Route::post('/get/files', 'AdminController@getFiles');

    //Usuarios

    Route::get('/get/usuarios', 'UserController@index');
    Route::get('/get/roles', 'UserController@getRoles');
    Route::post('/add/user', 'UserController@save');
    Route::put('/update/user', 'UserController@update');
    Route::delete('/delete/user/{id}', 'UserController@deleteUser');

    //Utils
    Route::get('/get/detailed/excel', 'UtilsController@detailedDump');
    Route::get('/get/bulk/excel', 'UtilsController@bulkDump');

});