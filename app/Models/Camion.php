<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    /**
 * @OA\Schema(
 *   schema="Camion",
 *   type="object",
 *   title="Camion",
 *   description="Información de un camión",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     format="int64",
 *     example=1
 *   ),
 *   @OA\Property(
 *     property="placa",
 *     type="string",
 *     description="Placa única del camión",
 *     example="ABC123"
 *   ),
 *   @OA\Property(
 *     property="modelo",
 *     type="string",
 *     description="Modelo del camión",
 *     example="Volvo FH16"
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

    protected $table = 'camiones'; // <--- Agrega esta línea

    protected $fillable = [
        'placa',
        'modelo'
    ];

    public function camioneros()
    {
        return $this->belongsToMany(Camionero::class, 'camioneros_camiones', 'camion_id', 'camionero_id');
    }

}
