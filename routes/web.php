<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
Route::get('/', function () {
    return view('/home');
});
*/


Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/cambiar/','clienteController@MostrarCambioContraseña');
Route::post('/cambioClave/','clienteController@storeCambiarClave');
//usuario
Route::get('/Usuarios/','General\UsuarioController@index');
Route::get('/nuevoUsuario/','General\UsuarioController@create');
Route::post('/usuario/store/','General\UsuarioController@store');
Route::post('/usuario/update/','General\UsuarioController@update');
Route::get('/usuario/edit/{id}', [
    'uses' => 'General\UsuarioController@edit',
    'as' => 'edit'
]);
Route::get('/usuario/delete/{id}',[
    'uses' => 'General\UsuarioController@delete',
    'as' => 'delete'
    ]);

//Perfiles
Route::get('/perfiles/','General\PerfilController@index');
Route::get('/crearPerfil/','General\PerfilController@create');
Route::post('/perfil/store/','General\PerfilController@store');

//rol
//detail
Route::get('/getRol/','General\RolController@getRol');
Route::get('/rolDetail/{id}','General\RolController@detail');

Route::get('/rol/','General\RolController@index');
Route::get('/crearRol/','General\RolController@create');
Route::post('/rol/store/','General\RolController@store');
Route::post('/rol/update/','General\RolController@update');

Route::get('/rol/edit/{id}', [
    'uses' => 'General\RolController@edit',
    'as' => 'edit'
]);
Route::get('/rol/delete/{id}', [
    'uses' => 'General\RolController@delete',
    'as' => 'edit'
]);
Route::get('/asignarRol/','General\RolController@AsignarRol');
Route::post('/asignarRol/store/','General\RolController@storeAsignarRol');
Route::get('/revovarRol/','General\RolController@revocarRol');
Route::get('/rolUsuario/{idUser}','General\RolController@buscarRol');
Route::post('/RevocarRolUsuario/','General\RolController@revocarRolUsuario');
//permiso
Route::get('/permisos/','General\PermisoController@index');
Route::get('/crearPermiso/','General\PermisoController@create');
Route::post('/permiso/store/','General\PermisoController@store');
Route::post('/permiso/update/','General\PermisoController@update');
Route::get('/permisos/edit/{id}', [
    'uses' => 'General\PermisoController@edit',
    'as' => 'edit'
]);
Route::get('/permisos/delete/{id}', [
    'uses' => 'General\PermisoController@delete',
    'as' => 'edit'
]);
Route::get('/asignarPermisos/','General\RolController@indexAsignarPermiso');
Route::post('/asignarPermiso/store/','General\RolController@storeAsignarPermiso');
Route::get('/revocarPermisos/','General\PermisoController@revocarPermiso');
Route::get('/rolPermiso/{id}','General\PermisoController@buscarPermiso');
Route::post('/RevocarRolPermiso/','General\PermisoController@revocarRolPermiso');


//transportistas
Route::get('/conductores/','General\ConductorController@index');
Route::get('/crearConductor/','General\ConductorController@create');
Route::post('/conductor/store/','General\ConductorController@store');
Route::post('/conductor/update/','General\ConductorController@update');
Route::get('/conductor/edit/{id}', [
    'uses' => 'General\ConductorController@edit',
    'as' => 'edit'
]);
Route::get('conductor/delete/{id}',[
    'uses' => 'General\ConductorController@delete',
    'as' => 'delete'
    ]);
//cliente
Route::get('/clientes','General\ClienteController@index');
Route::get('/crearCliente/','General\ClienteController@create');
Route::post('/cliente/store/','General\ClienteController@store');
Route::post('/cliente/update/','General\ClienteController@update');
Route::get('/clientes/edit/{id}', [
    'uses' => 'General\ClienteController@edit',
    'as' => 'edit'
]);
Route::get('clientes/delete/{id}',[
    'uses' => 'General\ClienteController@delete',
    'as' => 'delete'
    ]);
//Camiones
Route::get('/camiones','General\CamionController@index');
Route::get('/ingresarCamion/','General\CamionController@create');
Route::post('/camion/store/','General\CamionController@store');
Route::post('/camion/update/','General\CamionController@update');
Route::get('/camion/edit/{id}', [
    'uses' => 'General\CamionController@edit',
    'as' => 'edit'
]);
Route::get('/camion/delete/{id}', [
    'uses' => 'General\CamionController@delete',
    'as' => 'edit'
]);
//productos
Route::get('/productos/','General\ProductoController@index');
Route::get('/ingresarProducto/','General\ProductoController@create');
Route::post('/producto/store/','General\ProductoController@store');
Route::post('/producto/update/','General\ProductoController@update');
Route::get('/producto/edit/{id}', [
    'uses' => 'General\ProductoController@edit',
    'as' => 'edit'
]);
Route::get('/producto/delete/{id}', [
    'uses' => 'General\ProductoController@delete',
    'as' => 'edit'
]);
//Insumos
Route::get('/insumos/','General\InsumoController@index');
Route::get('/ingresarInsumo/','General\InsumoController@create');
Route::post('/insumo/store/','General\InsumoController@store');
Route::post('/insumo/update/','General\InsumoController@update');
Route::get('/insumo/edit/{id}', [
    'uses' => 'General\InsumoController@edit',
    'as' => 'edit'
]);
Route::get('/insumo/delete/{id}', [
    'uses' => 'General\InsumoController@delete',
    'as' => 'edit'
]);
//REPORTES del sistema
//Control de Teimpos
Route::get('/despacho/','General\ReportesController@IndexDespacho');
Route::post('/excel/','General\ReportesController@ExcelDespacho');
Route::get('/ver/reporteDespacho/{desde}/{hasta}/{idCliente}','General\ReportesController@previaDespacho');
Route::get('pdf',function(){
 /*  $pdf = PDF::loadView('admin.email');
    return $pdf->download('prueba.pdf');*/
    $pdf = App::make('dompdf.wrapper');
$pdf->loadView('admin.email');
return $pdf->stream();
});
Route::get('/previa/Despacho/{id}',[
    'uses'=>'General\ReportesController@previaDespacho',
    'as'=> 'Despacho'
    ]);



Route::get('prueba',function(){
    return view('admin.reportes.reporteDespacho');
});
///sastifaccion de los clientes
Route::get('/sastifaccionCliente/','General\SatisfaccionClienteController@index');
Route::get('/previa/sastifaccionCliente/{desde}/{hasta}/{idCliente}/{placa?}','General\SatisfaccionClienteController@create');
Route::post('/ver/excelSatisfaccion','General\SatisfaccionClienteController@ExcelReport');

//placas y chofer
Route::get('/placasChofer/','General\PlacasChoferController@index');
Route::get('/ver/placas/{desde}/{hasta}/{placa}','General\PlacasChoferController@create');
Route::get('/ver/reportePlacasChofer/','General\PlacasChoferController@show');
Route::post('/excel/reportePlacasChofer/','General\PlacasChoferController@ExcelReporte');

//Control lotes despacho
Route::get('/controlLotesDespacho/','General\ControlLotesDespachoController@search');
Route::get('/ver/controlLotesDespacho/{desde}/{hasta}/{idCliente}/{placa?}','General\ControlLotesDespachoController@index');
Route::post('/reporteExcel/','General\ControlLotesDespachoController@ExcelReport');


//Seguridad
//Opciones
Route::get('/opciones/','General\OpcionController@Index');
Route::get('/ingresarOpcion/','General\OpcionController@create');
Route::post('/opcion/store/','General\OpcionController@store');
Route::get('/opcion/edit/{id}', [
    'uses' => 'General\OpcionController@edit',
    'as' => 'edit'
]);

//Despacho a Clientes
Route::get('/despachoCliente/{desde?}/{hasta?}/{idCliente?}/',[
    'uses' => 'General\DespachoClienteController@index',
    'as' => 'despachoCliente'
    ]);
Route::get('/clientesDespacho/{desde}/{hasta}/{placa}/{apro?}/','General\DespachoClienteController@create');
Route::post('/despachoCliente/store','General\DespachoClienteController@store');
Route::post('/despachoCliente/storeProducto/','General\DespachoClienteController@storeProducto');
Route::get('/buscar/{fecha?}/{placa?}/{ticket?}',[
    'uses' => 'General\DespachoClienteController@search',
    'as' => 'buscar'
    ]);
Route::get('/detallesPT/{id}/', [
  'uses' => 'General\DespachoClienteController@detallesPT',
  'as' => 'detallesPT'
]);

//Route::get('/cargaTabla/','General\DespachoClienteController@create');
Route::get('/Inproducto/{id?}/{idCiclo}',[
    'uses' => 'General\DespachoClienteController@producto',
    'as' => 'Inproducto'
    ]);

/**/Route::get('/cargaTabla/{ids}',[
   'uses' => 'General\DespachoClienteController@getClients',
    'as' => 'cargaTabla'
    ]);
//PROVEEDOR
Route::get('/proveedores/','General\ProveedorController@index');
Route::get('/ingresarProveedor/','General\ProveedorController@create');
Route::post('/proveedor/store/','General\ProveedorController@store');
Route::post('/proveedor/update/','General\ProveedorController@update');
Route::get('/proveedor/edit/{id}', [
    'uses' => 'General\ProveedorController@edit',
    'as' => 'edit'
]);
Route::get('/proveedor/delete/{id}',[
    'uses' => 'General\ProveedorController@delete',
    'as' => 'delete'
    ]);
//SEGUIMIENTO
Route::get('/seguimiento/{cliente?}/{desde?}/{hasta?}','General\SeguimientoController@index');
Route::get('/seguimientoCreate/{cliente?}/{desde?}/{hasta?}','General\SeguimientoController@create');
Route::get('/detalles/{cliente}/{camion}/{codigo}/{desde}/{hasta}/{cod}', 'General\SeguimientoController@show');
Route::post('/detalles/store/','General\SeguimientoController@store');


//DATOS ADICIONALEs
Route::get('/datosAdicionales/','General\DatosAdicionalesController@index');
Route::post('/importExcel/','General\DatosAdicionalesController@store');

//ENCUESTA
Route::post('/encuesta/store/','General\EncuestaController@store');

//GUIA DE REMISION
Route::get('/guiaRemision','General\GuiaRemisionController@index');
Route::get('/show/{id}','General\GuiaRemisionController@create');
Route::get('/guia/{id}','General\GuiaRemisionController@guia');
Route::post('/subirGuia/','General\GuiaRemisionController@store');
Route::get('/subirGuia/show/{desde}/{hasta}/{idCliente}/','General\GuiaRemisionController@showg');
Route::get('/showGuia/{id}','General\GuiaRemisionController@show');


Route::get('/home/my-tokens', 'HomeController@getTokens')->name('personal-tokens');
Route::get('/home/my-clients', 'HomeController@getClients')->name('personal-clients');
Route::get('/home/authorized-clients', 'HomeController@getAuthorizedClients')->name('authorized-clients');
Route::get('/home', 'HomeController@index');


 //encuesta
Route::get('/encuesta/','General\EncuestaController@Index');
Route::get('/ingresarEncuesta/','General\EncuestaController@create');

//Recepcion de MP
Route::get('/recepcionMP/','General\RecepcionMP@index');
Route::get('/buscarMP/{desde}/{hasta}/{id}','General\RecepcionMP@create');
Route::get('/detallesMP/{id}','General\RecepcionMP@show');

//Reporte MP
Route::get('/reporte/materiaPrima/','General\RecepcionMP@reporteMP');
