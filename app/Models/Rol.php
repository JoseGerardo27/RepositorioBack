<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rols';
    public $timestamps =false ;

    protected $fillable = [
        'id', 'encargado', 'nombre', 'descripcion'
    ];

}
