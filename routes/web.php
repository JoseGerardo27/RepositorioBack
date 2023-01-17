<?php

use App\Http\Controllers\ColaboradorController;
use App\Models\Colaborador;
use Illuminate\Support\Facades\Route;

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

Route::get('/pdf', function () {
    $colaboradores = Colaborador::all();
    return view('Dom-PDF')->with('colaboradores',$colaboradores);;
});

Route::get('/pdf', function () {
    $colaboradores = Colaborador::all();
    return view('Dom-PDF')->with('colaboradores',$colaboradores);;
});

Route::get('/', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('download-pdf', [ColaboradorController::class, 'downloadPdf'])->name('download-pdf');
