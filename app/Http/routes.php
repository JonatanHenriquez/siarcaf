<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

/* Routes generales */

Route::get('/BusquedaDocumentos', function () {
    return view('General.BusquedaDocumentos');
});

/* Routes para Comisiones */

Route::get('/CrearComision', function () {
    return view('Comisiones.CrearComision');
});

Route::get('/AdministrarComisiones', function () {
    return view('Comisiones.AdministrarComision');
});

Route::get('/AdministrarIntegrantes', function () {
    return view('Comisiones.AdministrarIntegrantes');
});

Route::get('/HistorialDictamenesBitacoras', function () {
    return view('Comisiones.HistorialDictamenesBitacoras');
});

Route::get('/TrabajoComision', function () {
    return view('Comisiones.TrabajoComision');
});

Route::get('/ConvocatoriaComision', function () {
    return view('Comisiones.Convocatoria');
});

/* Peticiones */
Route::get('/RegistrarPeticion', function () {
    return view('General.RegistroPeticion');
});

/* Routes para Agenda */
Route::get('/CrearSesionPlenaria', function(){
	return view('Agenda.CrearSesionPlenaria');
});

Route:: get('/GestionarAsistencia', function(){
	return view('Agenda.GestionarAsistencia');
});

Route::get('/IniciarSesionPlenaria', function(){
	return view('Agenda.IniciarSesionPlenaria');
});
