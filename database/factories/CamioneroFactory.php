<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CamioneroFactory extends Factory
{
    protected $model = \App\Models\Camionero::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'documento' => $this->faker->unique()->numerify('########'),
            'telefono' => $this->faker->numerify('3#########'),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2000-01-01'),
            'licencia' => $this->faker->unique()->bothify('??#######'),
        ];
    }
}
