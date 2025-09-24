<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Camionero;
use App\Models\EstadoPaquete;

class PaqueteFactory extends Factory
{
    protected $model = \App\Models\Paquete::class;

    public function definition(): array
    {
        return [
            'camionero_id' => Camionero::factory(),
            'estado_id' => EstadoPaquete::factory(),
            'direccion' => $this->faker->address,
        ];
    }
}
