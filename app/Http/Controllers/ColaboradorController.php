<?php

namespace App\Http\Controllers;

use App\Filters\Search\FiltersP;
use App\Mail\OrderShipped;
use App\Mail\RestaurarPass;
use App\Models\Colaborador;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;
use Error;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Checks as Checks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $colaboradores = Colaborador::all();
        return view('colaborador.Dom-PDF')->with('colaboradores', $colaboradores); // tener cuidado al refenciar variables
    }

    public function index2(Request $r)
    {
        try {
            $w = (new FiltersP)->FilterColab($r);
            // $arreglo[] = json_decode($w->roles);
            return response()->json(['status' => 200, 'response' => $w]);
        } catch (Error $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    // Todos los Colaboradores
    public function downloadPdf(Request $r)
    {
        $colaboradores = (new FiltersP)->FilterColab($r);
        $colabs = [
            'user' => $colaboradores
        ];
        $pdf = PDF::loadView('Download', $colabs);
        $namepdf = 'PDF'; //$colaboradores->folio . '_' . $colaboradores->created_at->format('d-m-y') . '.pdf';
        $pdf->setPaper("Legal", "landscape");
        return $pdf->stream($namepdf);
    }

    // Un solo colaborador
    public function downloadPdfx1(Request $r)
    {
        $colaboradores = (new FiltersP)->FilterColab($r);
        $colabs = [
            'user' => $colaboradores
        ];
        $pdf = PDF::loadView('Download', $colabs);
        $namepdf = 'PDF'; //$colaboradores->folio . '_' . $colaboradores->created_at->format('d-m-y') . '.pdf';
        $pdf->setPaper("Legal", "landscape");
        return $pdf->stream($namepdf);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /////////////////////////////////////////////Para un solo documento////////////////////////////////////////////////////////
    // public function store(Request $r)
    // {
    //     try {
    //         $Nuevo = $r->id ? Colaborador::find($r->id) : new Colaborador();
    //         $Nuevo->departamento = $r->departamento;
    //         $Nuevo->nombre = $r->nombre;
    //         $Nuevo->id_rol = $r->id_rol; //id_rol
    //         $Nuevo->save();
    //         //Aqui comienza funcion guardar imagen
    //         $fm = Colaborador::all()->count();
    //         $n = 1;
    //         if (empty($Nuevo->folio)) {
    //             do {
    //                 $Nuevo->folio = 'AV-' . str_pad($fm + $n, 4, "0", STR_PAD_LEFT);
    //                 $n++;
    //             } while (!empty(Colaborador::where('folio', $Nuevo->folio)->first()));
    //             $Nuevo->save();
    //         }
    //         if ($r->image) {
    //             $m = $this->FileSave($Nuevo->doc_index, $r->image, $r->doc_index, $Nuevo->folio);
    //             $Nuevo->doc_index = $m;
    //             $Nuevo->save();
    //         }
    //         return response()->json(['status' => 200, 'response' => 'insertado correctamente']);
    //     } catch (Exception $e) {
    //         return response()->json(['status' => 500, 'response' => $e]);
    //     }
    // }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function store(Request $r)
    {
        try {
            $Nuevo = $r->id ? Colaborador::find($r->id) : new Colaborador();
            $Nuevo->departamento = $r->departamento;
            $Nuevo->nombre = $r->nombre;
            $Nuevo->correo = $r->correo;
            $Nuevo->id_rol = $r->id_rol; //id_rol
            $Nuevo->password = Crypt::encryptString($r->password);
            $b = Str::random(40);
            $Nuevo->token = $b;
            //Aqui comienza funcion guardar imagen
            $fm = Colaborador::all()->count();
            $n = 1;
            if (empty($Nuevo->folio)) {
                do {
                    $Nuevo->folio = 'AV-' . str_pad($fm + $n, 4, "0", STR_PAD_LEFT);
                    $n++;
                } while (!empty(Colaborador::where('folio', $Nuevo->folio)->first()));
                $Nuevo->save();
            }
            if ($r->doc_index) {
                $n = 1;
                //$encode = json_encode($Nuevo->doc_index) ;
                foreach ($r['doc_index'] as $value) {
                    $a = $this->FileSaveMultiples($Nuevo->doc_index, $value['nombre'], $value['base64'], $Nuevo->folio, $n);
                    if ($a) {
                        $lc[] = $a;
                    }
                    $n++;
                }
                $Nuevo->doc_index = json_encode($lc);
            }

            //Agregar un arreglo
            $Nuevo->roles = json_encode($r->roles);
            $Nuevo->save();
            return response()->json(['status' => 200, 'response' => 'insertado correctamente']);
        } catch (Error $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

// Inicio de Sesion
    public function LoginS(Request $r)
    {
        try {
            $w = Colaborador::where('id', $r->id)->first();
            $dpass = Crypt::decryptString($w->password);
            if ($dpass == $r->password) {
                $w->token = Str::random(60);
                $w->sesion = 1;
                $Nuevo = $r->id ? Colaborador::find($r->id) : new Colaborador();
                $Nuevo->sesion = $w->sesion;
                return response()->json(['status' => 200, 'response' =>  $w]);
            } else {
                return response()->json(['status' => 500, 'response' => $r]);
            }
        } catch (Error $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

// Cerrar Sesion
public function Logout(Request $r){
    try {
        $w = Colaborador::where('id', $r->id)->first();
      /*   $dpass = Crypt::decryptString($w->password);
        if ($dpass == $r->password) { */
            $w->token = Str::random(60);
            $w->sesion = 0;
            $Nuevo = $r->id ? Colaborador::find($r->id) : new Colaborador();
            $Nuevo->sesion = $w->sesion;
            $Nuevo->save();
            return response()->json(['status' => 200, 'response' => 'Sesión cerrada']);
        /* } else {
            return response()->json(['status' => 500, 'response' => 'Datos para cerrar sesión incorrectos']);
        } */
    } catch (Exception $e) {
        return response()->json(['status' => 500, 'response' => 'Error al cerrar sesion']);
    }
    }

      /* Cambio de Contraseña */
      public function NewPass(Request $r){
        try{
            $w = Colaborador::where('correo', $r->correo)->first();
            $w = Colaborador::where('id', $r->id)->first();
            $vp=Crypt::decryptString($w->password);
            if($vp!=$r->password){
                $w->password=Crypt::encryptString($r->password);
                    if($w->save()){
                        //$this->InsertPass($w->id,$r->pass); PARA EVALUAR QUE LAS CONTRASEÑAS NO SE REPITAN OTRA TABLA
                    $this->EmailAqui($w->id);
                    $w->save();
                        return response()->json(['status'=>200,'response'=>'Cambio de contraseñas exitoso']);
                    }else{
                        return response()->json(['status'=>500,'response'=>'Error al guardar la nueva contraseña']);
                    }
                }else{
                    return response()->json(['status'=>500,'response'=>'La contraseña insertada debe ser diferente a la contraseña actual']);
                }
            }catch(Error $e){
                return response()->json(['status'=> 500, 'response'=>$e]);
            }
        }


         //funcion envio de email para cambio contraseña
    public function EmailAqui($id)
    {
        try {
            $Nuevo = Colaborador::where('id', $id)->first();
            $Nuevo->save();
            $email = $Nuevo->correo;
             Mail::to($email)->send(new OrderShipped($Nuevo));
            if (count(Mail::failures()) > 0) {
                return response()->json(['status' => 500, 'response' => 'Error de inserción de correo']);
            }
            return response()->json(['status' => 200, 'response' => 'Email enviado']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function EmailRestaurar(Request $r)
    {
        try {
            $Nuevo = Colaborador::where('correo', $r->correo)->first();
            $email = $Nuevo->correo;
            $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longitud = 12;
            $pass = substr(str_shuffle($caracteres_permitidos), 0, $longitud);
            $Nuevo->password = Crypt::encryptString($pass);
            $Nuevo->save();
            Mail::to($email)->send(new RestaurarPass($Nuevo, $pass));
            return response()->json(['status' => 200, 'response' => $pass]);
        } catch (Error $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }





    public function FileSaveMultiples($originaldoc, $nombre, $base, $id_doc, $n)
    {
        try {
            if ($base) {
                $ext = explode('.', $nombre);
                $data = base64_decode($base);
                Storage::disk('workers')->put('/' . $id_doc . '_doc/' . $id_doc . '-' . $n . '.' . $ext[1], $data);
                return $id_doc . '-' . $n . '.' . $ext[1];
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => 'Error al insertar los datos: alguno de los campos no fue enviado correctamente para la inserccion de documento adjunto.']);
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

    //Obtencion documento indexado
    public function NuevoDocumento(Request $r)
    {
        try {
            $dg = Colaborador::where('id', $r->id)->first();
            return response()->file(public_path() . '\storage\workers\\' .$dg->folio.'_doc\\'. $r->doc_index);
        } catch (Error $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    //Funcion de guardado de archivos
    public function FileSave($originaldoc, $image, $name, $id_doc)
    {
        try {
            if ($originaldoc != null) {
                Storage::disk('workers')->delete($originaldoc);
            }
            $ext = explode('.', $name);
            $data = base64_decode($image);
            Storage::disk('workers')->put($id_doc . '.' . $ext[1], $data);
            return $id_doc . '.' . $ext[1];
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => 'Error al insertar los datos: alguno de los campos no fue enviado correctamente para la inserccion de documento adjunto.']);
        }
    }

    //funcion eliminar archivo indexado
    public function DeleteIndex(Request $r)
    {
        try {
            $an = Colaborador::find($r->id);
            Storage::disk('workers')->delete($an->doc_index);
            $an->doc_index = '';
            $an->save();
            return response()->json(['status' => 200, 'response' => 'indexado eliminado correctamente']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
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
    public function destroy(Request $r)
    {
        try{
            $eliminar = (new FiltersP)->FilterColab($r);
            $eliminar->delete();
            return response()->json([
                'res' => true,
                'mensaje' => 'eliminado correctamente'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }
}
