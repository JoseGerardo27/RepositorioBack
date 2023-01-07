<?php

namespace App\Http\Controllers;

use App\Filters\Search\FiltersP;
use App\Models\Colaborador;
use Exception;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        try {
            $w = (new FiltersP)->FilterColab($r);
            return response()->json(['status' => 200, 'response' => $w]);
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
        try{
            $Nuevo= $request->id?Colaborador::find($request->id): new Colaborador();
            $Nuevo->departamento=$request->departamento;
            $Nuevo->nombre=$request->nombre;
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
