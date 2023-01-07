<?php

use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\Prueba1Controller;
use App\Http\Controllers\Prueba2Controller;
use App\Http\Controllers\Prueba3Controller;
use App\Http\Controllers\RolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\prueba1;
use App\Models\prueba2;
/* use App\Http\Controllers\Prueba1Controller; */

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


  // Middleware para enviar todas las routes Web
Route::middleware('api')->group(function() {
    //Mostrar registros
    Route::get('/prueba1',[Prueba1Controller::class, 'index'])->name('prueba1');
    Route::get('/prueba2',[Prueba2Controller::class, 'index2'])->name('prueba2');
    Route::get('/prueba3',[Prueba3Controller::class, 'index'])->name('prueba3');
    Route::get('/colaboradores',[ColaboradorController::class, 'index'])->name('colaboradores');
    Route::get('/roles',[RolController::class, 'index'])->name('roles');
    //Crear
    Route::post('/newprueba1',[Prueba1Controller::class, 'store'])->name('newprueba1');
    Route::post('/newprueba2',[Prueba2Controller::class, 'store'])->name('newprueba2');
    Route::post('/newprueba3',[Prueba3Controller::class, 'store'])->name('newprueba3');
    Route::post('/newcolaborador',[ColaboradorController::class, 'store'])->name('newcolaborador');
    Route::post('/newrol',[RolController::class, 'store'])->name('newrol');
    // Eliminar
    Route::delete('/eliminar/{id}',[Prueba1Controller::class, 'destroy'])->name('eliminar');
    Route::delete('/eliminar2/{id}',[Prueba2Controller::class, 'destroy'])->name('eliminar2');
    Route::delete('/eliminar3/{id}',[Prueba3Controller::class, 'destroy'])->name('eliminar3');
});


