<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMercancia extends Model
{
        /**
 * @OA\Schema(
 *   schema="TipoMercancia",
 *   type="object",
 *   title="TipoMercancia",
 *   description="Catálogo de tipos de mercancías disponibles para los paquetes",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     format="int64",
 *     example=1
 *   ),
 *   @OA\Property(
 *     property="tipo",
 *     type="string",
 *     description="Nombre o categoría del tipo de mercancía",
 *     example="Electrodomésticos"
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

    // Nombre exacto de la tabla en la BD
    protected $table = 'tipo_mercancia';

    protected $fillable = [
        'tipo'
    ];

}
