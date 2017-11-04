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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


/**
 * Camion
 */
//Route::resource('camion', 'General\CamionController', ['only' => ['indexApi', 'showApi']]);
//Route::resource('camion', 'General\CamionController', ['except' => ['index', 'create', 'store', 'edit', 'destroy', 'update']]);



Route::group(['namespace' => 'api'], function () {
    Route::post('applogin/', 'UserController@login');
});


Route::get('userDetails/','api\UserController@details')->middleware('auth:api');
Route::get('camion/', 'General\CamionController@indexApi');
Route::get('camion/show/', 'General\CamionController@showApi');

//Route::resource('ingreso', 'General\IngresoController');
//Route::resource('ingreso', 'General\IngresoController', ['parameters' => [
//    'ingreso' => 'id'
//]]);

Route::get('ingreso/{id?}', 'General\IngresoController@index');
Route::get('aprobacion/{id?}', 'General\AprobacionController@index');
Route::get('pesoInicial/{id?}', 'General\PesadaInicialController@index');
Route::get('inspeccion/{id?}', 'General\InspeccionController@index');
Route::get('movimiento/{id?}', 'General\MovimientoController@index');
Route::get('pesoFinal/{id?}', 'General\PesadaFinalController@index');
Route::get('salida/{id?}', 'General\SalidaController@index');


/**
 * Users
 */
//Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);
//Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');
//Route::name('resend')->get('users/{user}/resend', 'User\UserController@resend');

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');