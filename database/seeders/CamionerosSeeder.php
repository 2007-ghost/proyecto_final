<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Camionero;
use Faker\Factory as Faker;

class CamionerosSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        Camionero::query()->delete();

        foreach (range(1, 10) as $i) {
            Camionero::create([
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'documento' => $faker->unique()->numerify('########'),
                'telefono' => $faker->numerify('3#########'), // solo números
                'fecha_nacimiento' => $faker->date('Y-m-d', '2000-01-01'),
                'licencia' => $faker->unique()->bothify('??#######'),
            ]);
        }
    }
}
