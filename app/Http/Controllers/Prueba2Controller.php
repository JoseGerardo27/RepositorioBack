<?php

namespace App\Http\Controllers;

use App\Filters\Search\FiltersP;
use App\Models\Prueba2;
use Illuminate\Http\Request;
use Exception;

class Prueba2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2(Request $r)
    {
        try {
            $w = (new FiltersP)->FilterP2($r);
            return response()->json(['status'=>200, 'response'=> $w]);
        } catch (Exception $e) {
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
            $Nuevo = $request->id ? Prueba2::find($request->id) : new Prueba2;
            $Nuevo->Numero = $request->Numero;
            $Nuevo->Pais = $request->Pais;
            $Nuevo->Estado = $request->Estado;
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
        try {
            $eliminar = Prueba2::find($id);
            $eliminar->delete();
            return response()->json([
                'res' => true,
                'mensaje' => 'Paciente eliminado correctamente'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }
}
