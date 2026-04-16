<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroFinanciero extends Model
{
    protected $table = 'registro_financieros';

    protected $fillable = [
        'usuario_id',
        'tipo_movimiento',
        'monto',
        'descripcion',
        'fecha_movimiento',
    ];
}