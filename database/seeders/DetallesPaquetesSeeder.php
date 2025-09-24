<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetallePaquete;
use App\Models\Paquete;
use App\Models\TipoMercancia;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DetallesPaquetesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        DetallePaquete::query()->delete();

        foreach (Paquete::all() as $paquete) {
            DetallePaquete::create([
                'paquete_id' => $paquete->id,
                'tipo_mercancia_id' => TipoMercancia::inRandomOrder()->first()->id,
                'peso' => $faker->randomFloat(2, 1, 100), // kg
                'dimension' => $faker->randomFloat(2, 0.1, 10), // m³
                'fecha_entrega' => Carbon::parse($paquete->created_at)->addDays(15),
            ]);
        }
    }
}
