<?php

use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\Prueba1Controller;
use App\Http\Controllers\Prueba2Controller;
use App\Http\Controllers\Prueba3Controller;
use App\Http\Controllers\RolController;
use App\Models\Colaborador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\prueba1;
use App\Models\prueba2;
use Illuminate\Support\Facades\Storage;

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
    Route::get('/colaboradores',[ColaboradorController::class, 'index2'])->name('colaboradores');
    Route::get('/roles',[RolController::class, 'index'])->name('roles');
    Route::get('/listas',[ListaController::class, 'index'])->name('listas');
    Route::get('/departamento',[DepartamentoController::class, 'index'])->name('departamento');
    //PDF
    Route::get('/PDF',[ColaboradorController::class, 'downloadPdf'])->name('PDF');
    Route::get('/PDFx1',[ColaboradorController::class, 'downloadPdfx1'])->name('PDF');

    //Crear
    Route::post('/newprueba1',[Prueba1Controller::class, 'store'])->name('newprueba1');
    Route::post('/newprueba2',[Prueba2Controller::class, 'store'])->name('newprueba2');
    Route::post('/newprueba3',[Prueba3Controller::class, 'store'])->name('newprueba3');
    Route::post('/newcolaborador',[ColaboradorController::class, 'store'])->name('newcolaborador');
    Route::post('/newrol',[RolController::class, 'store'])->name('newrol');
    Route::post('/newlista',[ListaController::class, 'store'])->name('newlista');

    // Eliminar
    Route::delete('/eliminar/{id}',[Prueba1Controller::class, 'destroy'])->name('eliminar');
    Route::delete('/eliminar2/{id}',[Prueba2Controller::class, 'destroy'])->name('eliminar2');
    Route::delete('/eliminar3/{id}',[Prueba3Controller::class, 'destroy'])->name('eliminar3');

    //imagen
    Route::get('/show_index',[ColaboradorController::class,'NuevoDocumento'])->name('show_index');
    Route::post('/delete_file_index',[ColaboradorController::class,'DeleteIndex'])->name('delete_file_index');

    Route::post('/delete_file_index',[ColaboradorController::class,'DeleteIndex'])->name('delete_file_index');

    // LOGIN
    Route::get('/LogIn',[ColaboradorController::class,'LoginS'])->name('LogIn');
    Route::get('/LogOut',[ColaboradorController::class,'Logout'])->name('LogOut');
    Route::post('/ChangePass',[ColaboradorController::class,'NewPass'])->name('ChangePass');
    Route::post('/RestaurarPass',[ColaboradorController::class,'EmailRestaurar'])->name('RestaurarPass');

});


