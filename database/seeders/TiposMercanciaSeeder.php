<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoMercancia;

class TiposMercanciaSeeder extends Seeder
{
    public function run()
    {
        TipoMercancia::query()->delete();

        $tipos = ['Electrónica', 'Alimentos', 'Ropa', 'Muebles', 'Materiales de construcción'];

        foreach ($tipos as $tipo) {
            TipoMercancia::create([
                'tipo' => $tipo,
            ]);
        }
    }
}
