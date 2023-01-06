<?php

namespace App\Filters\Search;

use App\Models\prueba1;
use App\Models\Prueba2;
use App\Models\prueba3;
use Illuminate\Http\Request;

class FiltersP
{
    public function __construct()
     {
        $this-> Deportes =[8=>'Baloncesto', 7=>'Golf',6=>'Futbol Americano',5=>'Voleibol',4=>'Tenis',3=>'Beisbol',
        2=>'Cricket',1=>'Futbol'];
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
        !$r->Nombre ?: $w->where('Nombre', 'like', '%' . $r->Nombre . '%'); // Los . nos sirven para concatenar
        !$r->Default ?: $w->where('Default', $r->Default);
        $w = $w->get();
        foreach($w as $wa)
        {
            $wa->NombreDeporte=$this->Deportes[$wa->Deporte];
        }
        return $w;
    }
}
