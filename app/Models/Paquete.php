<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    use HasFactory;

    protected $fillable = [
        'camionero_id',
        'estado_id',
        'direccion'
    ];

    public function camionero()
    {
        return $this->belongsTo(Camionero::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoPaquete::class, 'estado_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePaquete::class);
    }
}
