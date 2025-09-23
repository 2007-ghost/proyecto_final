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
}
