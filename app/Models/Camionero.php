<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camionero extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'licencia',
        'telefono'
    ];

    // app/Models/Camionero.php
public function camiones()
{
    return $this->belongsToMany(Camion::class, 'camioneros_camiones', 'camionero_id', 'camion_id');
}


    public function paquetes()
    {
        return $this->hasMany(Paquete::class);
    }
    /**
 * @OA\Schema(
 *     schema="Camionero",
 *     type="object",
 *     title="Camionero",
 *     required={"nombre","apellido","documento","telefono","fecha_nacimiento","licencia"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nombre", type="string", example="Juan"),
 *     @OA\Property(property="apellido", type="string", example="Perez"),
 *     @OA\Property(property="documento", type="string", example="12345678"),
 *     @OA\Property(property="telefono", type="string", example="3001234567"),
 *     @OA\Property(property="fecha_nacimiento", type="string", format="date", example="1990-01-01"),
 *     @OA\Property(property="licencia", type="string", example="A1234567"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
}



