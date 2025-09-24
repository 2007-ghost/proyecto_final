<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TipoMercanciaFactory extends Factory
{
    protected $model = \App\Models\TipoMercancia::class;

    public function definition(): array
    {
        return [
            'tipo' => $this->faker->word,
        ];
    }
}
