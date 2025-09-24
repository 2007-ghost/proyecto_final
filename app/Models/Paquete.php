<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
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
    /**
 * @OA\Schema(
 *     schema="Paquete",
 *     type="object",
 *     title="Paquete",
 *     required={"camionero_id","estado_id","direccion"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="camionero_id", type="integer", example=1),
 *     @OA\Property(property="estado_id", type="integer", example=1),
 *     @OA\Property(property="direccion", type="string", example="Calle 123"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */

}
