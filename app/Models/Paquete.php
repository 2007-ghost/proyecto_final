<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paquete extends Model
{
    /**
 * @OA\Schema(
 *   schema="Paquete",
 *   type="object",
 *   title="Paquete",
 *   description="Información de un paquete asignado a un camionero",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     format="int64",
 *     example=1
 *   ),
 *   @OA\Property(
 *     property="camionero_id",
 *     type="integer",
 *     description="ID del camionero responsable del paquete",
 *     example=3
 *   ),
 *   @OA\Property(
 *     property="estado_id",
 *     type="integer",
 *     description="ID del estado actual del paquete",
 *     example=2
 *   ),
 *   @OA\Property(
 *     property="direccion",
 *     type="string",
 *     description="Dirección de entrega del paquete",
 *     example="Cra 45 #10-20, Bogotá"
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

    // 👇 Muy importante si tu tabla es singular o diferente
    protected $table = 'paquetes';

    protected $fillable = [
        'camionero_id',
        'estado_id',
        'direccion'
    ];

    public function camionero()
    {
        return $this->belongsTo(Camionero::class, 'camionero_id');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoPaquete::class, 'estado_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePaquete::class, 'paquete_id');
    }

}
