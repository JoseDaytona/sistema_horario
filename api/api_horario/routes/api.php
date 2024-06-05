<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', 'AuthController@Login')->name('auth/login');

Route::group(['middleware' => 'auth:sanctum'], function () {

    //Aulas
    Route::get('aula/get_all', 'AulasController@get_all_aulas')->name('aula/get_all');
    Route::get('aula/get/{id}', 'AulasController@get_aula')->name('aula/get');
    Route::post('aula/store', 'AulasController@store_aula')->name('aula/store');
    Route::post('aula/update', 'AulasController@update_aula')->name('aula/update');
    Route::post('aula/destroy', 'AulasController@destroy_aula')->name('aula/destroy');
    
    //Campus
    Route::get('campus/get_all', 'CampusController@get_all_campus')->name('campus/get_all');
    Route::get('campus/get/{id}', 'CampusController@get_campus')->name('campus/get');
    Route::post('campus/store', 'CampusController@store_campus')->name('campus/store');
    Route::post('campus/update', 'CampusController@update_campus')->name('campus/update');
    Route::post('campus/destroy', 'CampusController@destroy_campus')->name('campus/destroy');

    //Edificio
    Route::get('edificio/get_all', 'EdificioController@get_all_edificios')->name('edificio/get_all');
    Route::get('edificio/get/{id}', 'EdificioController@get_edificio')->name('edificio/get');
    Route::post('edificio/store', 'EdificioController@store_edificio')->name('edificio/store');
    Route::post('edificio/update', 'EdificioController@update_edificio')->name('edificio/update');
    Route::post('edificio/destroy', 'EdificioController@destroy_edificio')->name('edificio/destroy');

    //Empleado
    Route::get('empleado/get_all', 'EmpleadoController@get_all_empleados')->name('empleado/get_all');
    Route::get('empleado/get/{id}', 'EmpleadoController@get_empleado')->name('empleado/get');
    Route::post('empleado/store', 'EmpleadoController@store_empleado')->name('empleado/store');
    Route::post('empleado/update', 'EmpleadoController@update_empleado')->name('empleado/update');
    Route::post('empleado/destroy', 'EmpleadoController@destroy_empleado')->name('empleado/destroy');

    //Reservaciones
    Route::get('reservaciones/get_all', 'ReservacionesController@get_all_reservaciones')->name('reservaciones/get_all');
    Route::get('reservaciones/get/{id}', 'ReservacionesController@get_reservacion')->name('reservaciones/get');
    Route::post('reservaciones/store', 'ReservacionesController@store_reservacion')->name('reservaciones/store');
    Route::post('reservaciones/update', 'ReservacionesController@update_reservacion')->name('reservaciones/update');
    Route::post('reservaciones/destroy', 'ReservacionesController@destroy_reservacion')->name('reservaciones/destroy');

    //Usuarios
    Route::get('usuario/get_all', 'UsuarioController@get_all_usuarios')->name('usuario/get_all');
    Route::get('usuario/get/{id}', 'UsuarioController@get_usuario')->name('usuario/get');
    Route::post('usuario/store', 'UsuarioController@store_usuario')->name('usuario/store');
    Route::post('usuario/update', 'UsuarioController@update_usuario')->name('usuario/update');
    Route::post('usuario/update_password', 'UsuarioController@update_password_usuario')->name('usuario/update_password');
    Route::post('usuario/destroy', 'UsuarioController@destroy_usuario')->name('usuario/destroy');
});
