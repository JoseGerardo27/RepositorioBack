<?php

namespace App\Filters\Search;

use App\Models\Colaborador;
use App\Models\prueba1;
use App\Models\Prueba2;
use App\Models\prueba3;
use App\Models\Rol;
use Illuminate\Http\Request;

class FiltersP
{
    public function __construct()
     {    //Arreglo de Objetos
        $this-> Deportes =[8=>'Baloncesto', 7=>'Golf',6=>'Futbol Americano',5=>'Voleibol',4=>'Tenis',3=>'Beisbol',
        2=>'Cricket',1=>'Futbol'];
        $this-> Roles =[8=>'Junta', 7=>'Investigar necesidades',6=>'Diseñar nuevo proyecto',5=>'Pruebas',4=>'Documentar',3=>'Corregir errores ',
        2=>'Lavar baño',1=>'Presentacion de informe'];
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
        foreach($w as $wa)
        {
           $wa->NombreDeporte =$wa->Deporte<9?$this->Deportes[$wa->Deporte]:'El valor no se encuentra en el arreglo';

        }
        return $w;
    }

    public function FilterColab(Request $r)
    {
        $w = (new Colaborador())->newQuery();
        !$r->id ?: $w->where('id', $r->id);
        !$r->nombre ?: $w->where('nombre', 'like', '%' . $r->nombre . '%');
        !$r->departamento ?: $w->where('departamento', 'like', '%' . $r->departamento . '%'); // Los . nos sirven para concatenar
        $w = $w->with('Roles')->get();
        return $w;
    }

    public function FilterRol(Request $r)
    {
        $w = (new Rol)->newQuery();
        !$r->id ?: $w->where('id', $r->id);
        !$r->idEncargado ?: $w->where('idEncargado', $r->idEncargado);
        !$r->nombre ?: $w->where('nombre', 'like', '%' . $r->nombre . '%');
        !$r->rol ?: $w->where('rol', $r->rol);
        $w = $w->get();
        foreach($w as $wa)
        {
           $wa->rol =$wa->rol<9?$this->Roles[$wa->rol]:'El rol no existe';
        }
        return $w;
    }
}
