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
}
