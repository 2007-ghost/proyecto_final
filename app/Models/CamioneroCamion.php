<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CamionerosCamione extends Pivot
{
    protected $table = 'camioneros_camiones';
}
