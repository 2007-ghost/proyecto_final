<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CamionFactory extends Factory
{
    protected $model = \App\Models\Camion::class;

    public function definition(): array
    {
        return [
            'placa' => strtoupper($this->faker->bothify('???###')),
            'modelo' => $this->faker->year,
        ];
    }
}
