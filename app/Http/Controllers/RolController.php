<?php

namespace App\Http\Controllers;

use App\Filters\Search\FiltersP;
use App\Models\Rol;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


Storage::disk('local')->put('example.txt', 'Contents');

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        try {
            $w = (new FiltersP)->FilterRol($r);
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
            $Nuevo= $request->id?Rol::find($request->id): new Rol();
            $Nuevo->nombre=$request->nombre;
            $Nuevo->rol=$request->rol;
            $Nuevo->descripcion=$request->descripcion;
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
