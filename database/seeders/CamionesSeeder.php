<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Camion;
use Faker\Factory as Faker;

class CamionesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        Camion::query()->delete();

        foreach (range(1, 5) as $i) {
            Camion::create([
                'placa' => strtoupper($faker->bothify('???###')),
                'modelo' => $faker->year,
            ]);
        }
    }
}
