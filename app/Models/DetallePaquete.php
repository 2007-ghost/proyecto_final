<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePaquete extends Model
{
    
/**
 * @OA\Schema(
 *   schema="DetallePaquete",
 *   type="object",
 *   title="DetallePaquete",
 *   description="Detalles específicos de un paquete",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     format="int64",
 *     example=1
 *   ),
 *   @OA\Property(
 *     property="paquete_id",
 *     type="integer",
 *     description="ID del paquete asociado",
 *     example=10
 *   ),
 *   @OA\Property(
 *     property="tipo_mercancia_id",
 *     type="integer",
 *     description="ID del tipo de mercancía",
 *     example=2
 *   ),
 *   @OA\Property(
 *     property="dimension",
 *     type="string",
 *     description="Dimensiones del paquete (largo x ancho x alto)",
 *     example="40x30x20 cm"
 *   ),
 *   @OA\Property(
 *     property="peso",
 *     type="number",
 *     format="float",
 *     description="Peso del paquete en kilogramos",
 *     example=12.5
 *   ),
 *   @OA\Property(
 *     property="fecha_entrega",
 *     type="string",
 *     format="date",
 *     description="Fecha estimada de entrega del paquete",
 *     example="2025-10-15"
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

    // 👇 Muy importante: tu tabla es plural
    protected $table = 'detalles_paquetes';

    protected $fillable = [
        'paquete_id',
        'tipo_mercancia_id',
        'dimension',
        'peso',
        'fecha_entrega'
    ];

    // Relaciones
    public function paquete()
    {
        return $this->belongsTo(Paquete::class);
    }

    public function tipoMercancia()
    {
        return $this->belongsTo(TipoMercancia::class, 'tipo_mercancia_id');
    }

}
