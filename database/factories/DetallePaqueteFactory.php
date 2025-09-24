<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paquete;
use App\Models\TipoMercancia;

class DetallePaqueteFactory extends Factory
{
    protected $model = \App\Models\DetallePaquete::class;

    public function definition(): array
    {
        return [
            'paquete_id' => Paquete::factory(),
            'tipo_mercancia_id' => TipoMercancia::factory(),
            'dimension' => $this->faker->randomFloat(2, 1, 10),
            'peso' => $this->faker->randomFloat(2, 0.1, 50),
            'fecha_entrega' => now()->addDays(15),
        ];
    }
}
