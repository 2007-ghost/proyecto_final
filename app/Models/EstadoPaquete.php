<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPaquete extends Model
{
        /**
 * @OA\Schema(
 *   schema="EstadoPaquete",
 *   type="object",
 *   title="EstadoPaquete",
 *   description="Estados posibles de un paquete",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     format="int64",
 *     example=1
 *   ),
 *   @OA\Property(
 *     property="estado",
 *     type="string",
 *     description="Nombre del estado del paquete",
 *     example="En tránsito"
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

    // 👇 Muy importante porque tu tabla es plural
    protected $table = 'estados_paquetes';

    protected $fillable = [
        'estado'
    ];


}
