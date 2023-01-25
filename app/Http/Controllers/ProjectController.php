<?php

namespace App\Http\Controllers;

use App\Filters\Search\FiltersP;
use App\Models\Historial;
use App\Models\ProyectoCot;
use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        try {
            $w = (new FiltersP)->FilterCotizador($r);
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
    public function store(Request $r)
    {
        DB::beginTransaction();
        try {
           $coment =  $r->com ?  : $r->com = '';
            $Nuevo = $r->id ? ProyectoCot::find($r->id) : new ProyectoCot();
            $Nuevo->id_worker = $r->id_worker;
            $Nuevo->id_assistant = $r->id_assistant;
            $ap = [];
            array_push($ap, $r->product_list);
            $Nuevo->product_list = json_encode($ap);
            $Nuevo->id_client = $r->id_client;
            $Nuevo->id_proyect = $r->id_proyect;
            $Nuevo->city = $r->city;
            if($r->id_father)
            {
                $Padre = ProyectoCot::find($r->id_father);
                $Padre->active = 2;
                $Padre->save();
            }
            $Nuevo->id_father = $r->id_father;
            $Nuevo->value = $r->value;
            $Nuevo->save();

            Historial::insert(['id_Project' => $Nuevo->id, 'mov' =>  $r->id ? 'M' :  'G', 'comment' => $coment,
            'updated_at' => Carbon::now(), 'id_worker' => $r->id_worker]);

            DB::commit();
            return response()->json(['status' => 200, 'response' => 'insertado correctamente']);
        } catch (Error $e) {
            DB::rollBack();
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
    public function Cancelado(Request $r)
    {
        DB::beginTransaction();
        try{
            $Nuevo = ProyectoCot::find($r->id);
        if($Nuevo->id_father!=NULL)
        {
            $Padre = ProyectoCot::find($Nuevo->id_father);
            $Padre->active = 1;
            $Padre->save();
        }
        $Nuevo->cancel = 1;
        $Nuevo->save();
        DB::commit();
        return response()->json(['status' => 200, 'response' => 'cancelado correctamente']);
        }catch(Exception $e)
        {
            DB::rollBack();
            return response()->json(['status' => 500, 'response' => $e]);
        }

    }

    public function firma(Request $r)
    {
        DB::beginTransaction();
        try{
            $coment =  $r->com ?  : $r->com = '';
            $Nuevo = ProyectoCot::find($r->id);
            $Nuevo->active = 1;
            $Nuevo->status = 1;
            $Nuevo->save();

                $Padre = ProyectoCot::find($Nuevo->id_father);
                $Padre->active = 3;
                $Padre->status = 0;
                $Padre->save();

            Historial::insert(['id_Project' => $Nuevo->id, 'mov' =>  'L', 'comment' => $coment,
            'updated_at' => Carbon::now(), 'id_worker' => $r->id_worker]);

        DB::commit();
        return response()->json(['status' => 200, 'response' => 'firmado correctamente']);
        }catch(Exception $e)
        {
            DB::rollBack();
            return response()->json(['status' => 500, 'response' => $e]);
        }

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
