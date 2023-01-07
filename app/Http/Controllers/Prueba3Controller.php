<?php

namespace App\Http\Controllers;

use App\Filters\Search\FiltersP;
use App\Models\prueba3;
use Error;
use Exception;
use Illuminate\Http\Request;

class Prueba3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $r)
    {

        try{
            $w =(new FiltersP)->FilterP3($r);
            return response()->json(['status'=>200,'response'=>$w]);
           }catch(Error $e){
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
        try{
            $Nuevo= $request->id?prueba3::find($request->id): new prueba3;
            $Nuevo->Numero=$request->Numero;
            $Nuevo->Deporte=$request->Deporte;
            $Nuevo->save();
           return response()->json(['status'=>200,'response'=>'insertado correctamente']);
            }catch(Exception $e){

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
        try{
            $eliminar = prueba3::find($id);

            $eliminar->delete();
            return response()->json([
                'res'=> true,
                'mensaje' => 'Paciente eliminado correctamente'
            ],200);
        }catch(Exception $e){
            return response()->json(['status'=>500,'response'=>$e]);
        }
    }
}
