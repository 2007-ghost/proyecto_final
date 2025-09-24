<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoPaquete;

class EstadosPaquetesSeeder extends Seeder
{
    public function run()
    {
        EstadoPaquete::query()->delete();

        $estados = ['Pendiente', 'En tránsito', 'Entregado', 'Devuelto', 'Cancelado'];

        foreach ($estados as $estado) {
            EstadoPaquete::create([
                'estado' => $estado,
            ]);
        }
    }
}
