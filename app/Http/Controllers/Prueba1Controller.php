<?php

namespace App\Http\Controllers;

use App\Filters\Search\FiltersP;
use Illuminate\Http\Request;
use App\Models\prueba1;
use Error;
use Exception;

class Prueba1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        try{
     return $w =(new FiltersP)->FilterP($r);
    }catch(Exception $e){
        return response()->json(['status'=>500,'response'=>$e]);
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
        // $resultado = $condicion ? 'verdadero' : 'falso';
        // $resultado = $valor ?: 'defecto';
        try{
        $Nuevo= $request->id?Prueba1::find($request->id): new Prueba1;
        $Nuevo->Numero=$request->Numero;
        $Nuevo->Nombre=$request->Nombre;
        $Nuevo->Descripcion=$request->Descripcion;
        $Nuevo->save();
        return response()->json(['status'=>200,'response'=>'insertado correctamente']);
        }catch(Exception $e){
            return response()->json(['status'=>500,'response'=>$e]);
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
        try{
        $eliminar = prueba1::find($id);

        $eliminar->delete();
        return response()->json([
            'res'=> true,
            'mensaje' => 'eliminado correctamente'
        ],200);
    }catch(Exception $e){
        return response()->json(['status'=>500,'response'=>$e]);
    }
}
}
