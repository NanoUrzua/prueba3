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
*/

Route::get('/inicio', 'PageController@inicio')->name('home');
Route::get('/iniciarSesion', 'PageController@inicioSesion')->name('login');
Route::get('/registroUsuario', 'PageController@registroUsuario')->name('register');
Route::get('/crudPolera', 'EnviarDatosController@rellenarComboBox')->name('crud');
Route::get('/', 'EnviarDatosController@cerrarSesion')->name('logout');

Route::post('/registroUsuario', 'EnviarDatosController@recibirDatos')->name('insertUser');
Route::post('/iniciarSesion', 'EnviarDatosController@iniciarUsuario')->name('loginUser');
Route::post('/', 'EnviarDatosController@agregarPolera')->name('insertShirt');
Route::post('/modificarPolera', 'EnviarDatosController@obtenerIdParaModificar')->name('getIdUpdate');
Route::post('/eliminarPolera', 'EnviarDatosController@obtenerIdParaEliminar')->name('getIdDelete');

Route::patch('/modificarPolera/{id}', 'EnviarDatosController@modificarPolera')->name('updateShirt');

Route::delete('/eliminarPolera/{id}', 'EnviarDatosController@eliminarPolera')->name('deleteShirt');
