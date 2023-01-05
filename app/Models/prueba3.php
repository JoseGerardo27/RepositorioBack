<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prueba3 extends Model
{
    protected $table = 'prueba3s';
    public $timestamps =false ;
    use HasFactory;

    protected $fillable= [
        'Numero',
        'Deporte',
    ];
}
