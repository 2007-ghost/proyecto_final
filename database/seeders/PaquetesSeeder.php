<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paquete;
use App\Models\Camionero;
use App\Models\EstadoPaquete;
use Faker\Factory as Faker;

class PaquetesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        Paquete::query()->delete();

        foreach (range(1, 10) as $i) {
            Paquete::create([
                'camionero_id' => Camionero::inRandomOrder()->first()->id,
                'estado_id' => EstadoPaquete::inRandomOrder()->first()->id,
                'direccion' => $faker->address,
            ]);
        }
    }
}
