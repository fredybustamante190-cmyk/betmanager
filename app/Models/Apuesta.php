<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apuesta extends Model
{
    protected $table = 'apuestas';

protected $fillable = [
    'usuario_id',
    'nombre_apuesta',
    'tipo_apuesta',
    'monto',
    'fecha_apuesta',
    'estado',
];
}