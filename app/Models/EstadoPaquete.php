<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPaquete extends Model
{
    use HasFactory;

    protected $fillable = ['estado'];

    public function paquetes()
    {
        return $this->hasMany(Paquete::class, 'estado_id');
    }
}

