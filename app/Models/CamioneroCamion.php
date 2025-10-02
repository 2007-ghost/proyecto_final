<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CamioneroCamion extends Pivot
{
    protected $table = 'camioneros_camiones';
    
}
