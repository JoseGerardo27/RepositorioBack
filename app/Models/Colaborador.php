<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;
    protected $table = 'colaboradors';
    public $timestamps = false;

    protected $fillable = [
        'id', 'nombre', 'departamento'
    ];

    public function Roles()
    {
        return $this->hasMany(Rol::class, 'idEncargado', 'id');
    }
}
