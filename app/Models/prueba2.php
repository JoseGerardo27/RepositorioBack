<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba2 extends Model
{
    use HasFactory;
    protected $table = 'prueba2s';
    public $timestamps =false ;

    protected $fillable= [
        'id',
        'Numero',
        'Pais',
        'Estado',
    ];
}
