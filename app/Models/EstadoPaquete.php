<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPaquete extends Model
{
    use HasFactory;

    // 👇 Muy importante porque tu tabla es plural
    protected $table = 'estados_paquetes';

    protected $fillable = [
        'estado'
    ];
}
