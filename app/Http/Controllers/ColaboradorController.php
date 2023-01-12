<?php

namespace App\Http\Controllers;

use App\Filters\Search\FiltersP;
use App\Models\Colaborador;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;
use Error;

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
            return response()->json(['status' => 200, 'response' => $w]);
        } catch (Exception $e) {
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
            $Nuevo->id_rol = $r->id_rol; //id_rol
            $Nuevo->save();
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
                foreach ($r->doc_index as $value) {
                    $a = $this->FileSaveMultiples($Nuevo->doc_index, $value->nombre, $value->base, $Nuevo->folio);
                    if ($a) {
                        $lc[] = $a;
                    }
                }
                $Nuevo->doc_index = json_encode($lc);
            }
            return response()->json(['status' => 200, 'response' => 'insertado correctamente']);
        } catch (Error $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }


    public function FileSaveMultiples($originaldoc, $nombre, $base, $id_doc)
    {
        try {
            if ($base) {
                $ext = explode('.', $nombre);
                $data = base64_decode($base);
                Storage::disk('dms')->put('/' . $id_doc . '_doc/' . $nombre, $data);
                return $nombre;
            }
            return $nombre;
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
            $dg = Colaborador::select('doc_index')->where('id', $r->id)->first();
            return response()->file(public_path() . '\storage\workers\\' . $dg->doc_index);
        } catch (Exception $e) {
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
    public function destroy($id)
    {
        //
    }
}
