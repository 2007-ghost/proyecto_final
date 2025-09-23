<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMercancia extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla en la BD
    protected $table = 'tipo_mercancia';

    protected $fillable = [
        'tipo'
    ];
}
