<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
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
