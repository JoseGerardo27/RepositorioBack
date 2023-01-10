<?php

namespace App\Http\Controllers;

use App\Filters\Search\FiltersP;
use App\Models\Lista;
use Error;
use Exception;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        try {
            $w = (new FiltersP())->FilterLista($r);
            return response()->json(['status' => 200, 'response' => $w]);
        } catch (Error $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $Nuevo = $request->id ? Lista::find($request->id) : new Lista;
            $Nuevo->nombre = $request->nombre;
            $Nuevo->numero = $request->numero;
            $Nuevo->equipo = $request->equipo;
            $Nuevo->save();
            return response()->json(['status' => 200, 'response' => 'insertado correctamente']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
