<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_Project',
        'mov',
        'comment',
        'updated_at',
        'id_worker',
    ];
}
