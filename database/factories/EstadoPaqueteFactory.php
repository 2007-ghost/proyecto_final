<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EstadoPaqueteFactory extends Factory
{
    protected $model = \App\Models\EstadoPaquete::class;

    public function definition(): array
    {
        return [
            'estado' => $this->faker->randomElement(['Pendiente','En camino','Entregado','Cancelado']),
        ];
    }
}
