<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prueba1 extends Model
{
    use HasFactory;

    protected $table = 'prueba1s'; // Protocolo
    public $timestamps =false ; // Cuando no se utilice el timestamps hacerlo false

    protected $fillable= [
    'id',
    'Numero',
    'Nombre',
    'Descripcion',
    'Default'
];
public function p2()
{
    return $this->hasOne(Prueba2::class, 'Numero','Numero');
}

public function p3()
{
    return $this->hasOne(Prueba3::class, 'Numero','Numero');
}


}
