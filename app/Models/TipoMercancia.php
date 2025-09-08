<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMercancia extends Model
{
    use HasFactory;

    protected $fillable = ['tipo'];

    public function detallesPaquetes()
    {
        return $this->hasMany(DetallePaquete::class, 'tipo_mercancia_id');
    }
}
