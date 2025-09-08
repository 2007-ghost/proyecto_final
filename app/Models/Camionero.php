<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camionero extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'licencia',
        'telefono'
    ];

    // app/Models/Camionero.php
public function camiones()
{
    return $this->belongsToMany(Camion::class, 'camioneros_camiones', 'camionero_id', 'camion_id');
}


    public function paquetes()
    {
        return $this->hasMany(Paquete::class);
    }
}
