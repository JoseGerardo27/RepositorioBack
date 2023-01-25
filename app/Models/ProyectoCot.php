<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoCot extends Model
{
    use HasFactory;
    protected $fillable = [
    'id',
    'id_worker',
    'id_assistant',
    'product_list',
    'id_client',
    'id_proyect',
    'city',
    'id_father',
    'active',
    'cancel',
    'value',
    'status'
];
}
