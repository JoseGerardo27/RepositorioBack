<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;
    protected $table = 'listas'; // Protocolo
    public $timestamps =false ; // Cuando no se utilice el timestamps hacerlo false
    protected $fillable=[
        'id', 'nombre', 'numero', 'equipo'
    ];
}
