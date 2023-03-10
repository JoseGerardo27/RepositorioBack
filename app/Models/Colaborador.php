<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;
    protected $table = 'colaboradors';
    public $timestamps =false ; // Cuando no se utilice el timestamps hacerlo false

    protected $fillable = [
        'id', 'nombre', 'departamento', 'doc_index', 'id_rol', 'folio', 'token', 'password', 'sesion', 'correo'
    ];

    public function DepartamentoNombre()
{
    return $this->hasOne(Departamento::class, 'id','departamento');
}
    public function Roles()
    {
        return $this->hasMany(Rol::class, 'id', 'id_rol');
    }
}
