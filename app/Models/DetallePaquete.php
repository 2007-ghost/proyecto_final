<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePaquete extends Model
{
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
    /**
 * @OA\Schema(
 *     schema="DetallePaquete",
 *     type="object",
 *     title="DetallePaquete",
 *     required={"paquete_id","tipo_mercancia_id","dimension","peso","fecha_entrega"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="paquete_id", type="integer", example=1),
 *     @OA\Property(property="tipo_mercancia_id", type="integer", example=1),
 *     @OA\Property(property="dimension", type="number", example=10.5),
 *     @OA\Property(property="peso", type="number", example=5.2),
 *     @OA\Property(property="fecha_entrega", type="string", format="date", example="2025-10-10"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
}
