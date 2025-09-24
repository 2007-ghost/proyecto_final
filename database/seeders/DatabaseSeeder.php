<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CamionerosSeeder::class,
            CamionesSeeder::class,
            EstadosPaquetesSeeder::class,
            PaquetesSeeder::class,
            TiposMercanciaSeeder::class,
            DetallesPaquetesSeeder::class,
        ]);
    }
}
