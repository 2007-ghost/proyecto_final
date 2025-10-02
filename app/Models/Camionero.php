<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camionero extends Model
{
    /**
 * @OA\Schema(
 *   schema="Camionero",
 *   type="object",
 *   title="Camionero",
 *   description="Información de un camionero",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     format="int64",
 *     example=1
 *   ),
 *   @OA\Property(
 *     property="documento",
 *     type="string",
 *     description="Documento de identificación del camionero",
 *     example="1029384756"
 *   ),
 *   @OA\Property(
 *     property="nombre",
 *     type="string",
 *     description="Nombre del camionero",
 *     example="Carlos"
 *   ),
 *   @OA\Property(
 *     property="apellido",
 *     type="string",
 *     description="Apellido del camionero",
 *     example="Pérez"
 *   ),
 *   @OA\Property(
 *     property="fecha_nacimiento",
 *     type="string",
 *     format="date",
 *     description="Fecha de nacimiento del camionero",
 *     example="1985-06-20"
 *   ),
 *   @OA\Property(
 *     property="licencia",
 *     type="string",
 *     description="Número de licencia de conducción",
 *     example="LIC123456"
 *   ),
 *   @OA\Property(
 *     property="telefono",
 *     type="string",
 *     description="Número de teléfono del camionero",
 *     example="+57 3001234567"
 *   ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     format="date-time",
 *     example="2025-01-01T12:00:00Z"
 *   ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     format="date-time",
 *     example="2025-01-01T12:00:00Z"
 *   )
 * )
 */

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

}



