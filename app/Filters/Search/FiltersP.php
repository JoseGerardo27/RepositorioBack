<?php

namespace App\Filters\Search;

use App\Models\Colaborador;
use App\Models\Departamento;
use App\Models\Lista;
use App\Models\prueba1;
use App\Models\Prueba2;
use App\Models\prueba3;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FiltersP
{
    public function __construct()
    {    //Arreglo de Objetos
        $this->Deportes = [
            8 => 'Baloncesto', 7 => 'Golf', 6 => 'Futbol Americano', 5 => 'Voleibol', 4 => 'Tenis', 3 => 'Beisbol',
            2 => 'Cricket', 1 => 'Futbol'
        ];
        $this->Roles = [
            8 => 'Junta', 7 => 'Investigar necesidades', 6 => 'Diseñar nuevo proyecto', 5 => 'Pruebas', 4 => 'Documentar', 3 => 'Corregir errores ',
            2 => 'Lavar bano', 1 => 'Presentacion de informe'
        ];
        $this->Departamentos = [
            8 => 'Direccion', 7 => 'Desarrollo Organizacional', 6 => 'Contabilidad', 5 => 'Pruebas', 4 => 'Compras', 3 => 'Calidad',
            2 => 'Almacen', 1 => 'Administración', 9 => 'Facility', 10 => 'Facturacion', 11 => 'Gerencia', 12 => 'Gestion de Proyectos', 13 => 'Ingenieria', 14 => 'Intendencia', 15 => 'Legal',
            16 => 'Logistica', 17 => 'Mercadotecnica', 18 => 'Operaciones', 19 => 'Produccion', 20 => 'Seguridad e Higiene', 21 => 'Seguridad Patrimonial', 22 => 'Sistemas', 23 => 'Soluciones Convergentes', 24 => 'Soporte Tecnico',
            25 => 'Ventas Corporativas', 26 => 'Ventas Retail', 27 => 'Control de Inventarios', 28 => 'Credito y Cobranza', 29 => 'Cuentas por Pagar', 30 => 'Mantenimiento', 31 => 'Tesoreria', 32 => 'Ventas Manofactura',
            33 => 'Pendiente'
        ];
    }

    public function FilterP(Request $r)
    {
        $w = (new prueba1)->newQuery();
        !$r->Numero ?: $w->where('Numero', $r->Numero);
        !$r->id ?: $w->where('id', $r->id);
        !$r->Nombre ?: $w->where('Nombre', 'like', '%' . $r->Nombre . '%'); // Los . nos sirven para concatenar
        !$r->Default ?: $w->where('Default', $r->Default);
        $w = $w->with('p2')->with('p3')->get();
        return $w;
    }

    public function FilterP2(Request $r)
    {
        $w = (new Prueba2())->newQuery();
        !$r->Numero ?: $w->where('Numero', $r->Numero);
        !$r->id ?: $w->where('id', $r->id);
        !$r->Nombre ?: $w->where('Nombre', 'like', '%' . $r->Nombre . '%'); // Los . nos sirven para concatenar
        !$r->Default ?: $w->where('Default', $r->Default);
        $w = $w->get();
        return $w;
    }

    public function FilterP3(Request $r)
    {
        $w = (new prueba3())->newQuery();
        !$r->Numero ?: $w->where('Numero', $r->Numero);
        !$r->id ?: $w->where('id', $r->id);
        !$r->Deporte ?: $w->where('Deporte', $r->Deporte);
        $w = $w->get();
        foreach ($w as $wa) {
            $wa->NombreDeporte = $wa->Deporte < 9 ? $this->Deportes[$wa->Deporte] : 'El valor no se encuentra en el arreglo';
        }
        return $w;
    }

    public function FilterColab(Request $r)
    {
        $w = (new Colaborador())->newQuery();
        !$r->id ?: $w->where('id', $r->id);
        !$r->correo ?: $w->where('correo', $r->correo);
        !$r->nombre ?: $w->where('nombre', 'like', '%' . $r->nombre . '%');
        !$r->departamento ?: $w->where('departamento', $r->departamento);
        !$r->id_rol ?: $w->where('id_rol', $r->id_rol);
        !$r->folio ?: $w->where('folio', $r->folio);
        // $w = $w->with('Roles')->get();
        // Para imprimir el rol de otra tabla
        // foreach($w as $wa)
        // {
        //     foreach($wa->Roles as $Roles)
        //     {
        //         $Roles->NameRol = $this-> Roles [$Roles->rol];
        //     }
        // }
        if ($r->roles) {
            $w2 =  explode(',', $r->roles);
            $w->where(function ($q) use ($w2) {
                foreach ($w2 as $wa) {
                    $q->orWhereJsonContains('roles', $wa);
                }
            });
        }

       /*  if ($r->departamento) {
            $w3 =  explode(',', $r->departamento);
            $w->where(function ($p) use ($w3) {
                foreach ($w3 as $wa) {
                    $p->orWhereJsonContains('departamento', $wa);
                }
            });
        } */

// crear arreglo y agregarle roles y nombre
        $empleado = Colaborador::where('id', 1)->get();
        $w = $w->with('DepartamentoNombre')->get();
        // hacer llegar en arreglo al front
        foreach ($w as $wa) {
            $wa->roles = json_decode($wa->roles);
            {
                $wa->doc_index = json_decode($wa->doc_index);
            $Nombre_Rol = array();
           unset($wa->DepartamentoNombre->id, $wa->DepartamentoNombre->nomenclature);
            foreach($wa->roles as $prr2)
                if($prr2>8){array_push($Nombre_Rol,'El rol no existe');}
                else{
                  $temporal2 = intval($prr2);
                array_push($Nombre_Rol, $this->Roles[$temporal2]);
                $wa->Names_Rols = $Nombre_Rol;
                }

            }
        }

        return $w;
    }


    public function FilterDpto(Request $r)
    {
        $w = (new Departamento())->newQuery();
        !$r->id ?: $w->where('id', $r->id);
        !$r->name ?: $w->where('name', $r->name);
        !$r->nomenclature ?: $w->where('nomenclature', $r->nomenclature);
        $w = $w->get();
        return $w;
    }

    public function FilterRol(Request $r)
    {
        $w = (new Rol)->newQuery();
        !$r->id ?: $w->where('id', $r->id);
        !$r->nombre ?: $w->where('nombre', 'like', '%' . $r->nombre . '%');
        !$r->rol ?: $w->where('rol', $r->rol);
        $w = $w->get();
        foreach ($w as $wa) {
            $wa->nombre_rol = $wa->rol < 9 ? $this->Roles[$wa->rol] : 'El rol no existe';
        }
        return $w;
    }

    public function FilterLista(Request $r)
    {
        $w = (new Lista)->newQuery();
        !$r->numero ?: $w->where('numero', $r->Numero);
        !$r->id ?: $w->where('id', $r->id);
        !$r->equipo ?: $w->where('equipo', $r->Deporte);
        !$r->nombre ?: $w->where('nombre', 'like', '%' . $r->nombre . '%');
        $w = $w->get();
        return $w;
    }
}
