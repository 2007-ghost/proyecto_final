<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Camionero;
use App\Models\EstadoPaquete;
use App\Models\Paquete;
use App\Models\TipoMercancia;
use Carbon\Carbon;

class PaqueteTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $headers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $token = $this->user->createToken('auth_token')->plainTextToken;
        $this->headers = ['Authorization' => "Bearer $token"];

        // Crear recursos base
        Camionero::factory()->count(2)->create();
        EstadoPaquete::firstOrCreate(['estado' => 'Pendiente']);
        EstadoPaquete::firstOrCreate(['estado' => 'En camino']);
        TipoMercancia::factory()->count(2)->create();
    }

    /** @test */
    public function crea_paquete()
    {
        $camionero = Camionero::first();
        $estado = EstadoPaquete::first();

        $data = [
            'camionero_id' => $camionero->id,
            'estado_id' => $estado->id,
            'direccion' => 'Calle 123'
        ];

        $response = $this->postJson('/api/paquetes', $data, $this->headers);
        $response->assertStatus(201)->assertJsonStructure(['data' => ['id', 'camionero', 'estado', 'direccion', 'created_at', 'updated_at']]);
    }

    /** @test */
    public function crea_detalle_paquete()
    {
        $camionero = Camionero::first();
        $estado = EstadoPaquete::first();
        $tipo = TipoMercancia::first();

        $paquete = Paquete::create([
            'camionero_id' => $camionero->id,
            'estado_id' => $estado->id,
            'direccion' => 'Calle de prueba 123'
        ]);

        $data = [
            'paquete_id' => $paquete->id,
            'tipo_mercancia_id' => $tipo->id,
            'dimension' => 10.5,
            'peso' => 5.2,
            'fecha_entrega' => now()->addDays(15)->toDateString(),
        ];

        $response = $this->postJson('/api/detalles-paquetes', $data, $this->headers);
        $response->assertStatus(201)->assertJsonStructure([
            'data' => ['id', 'paquete_id', 'tipo_mercancia_id', 'dimension', 'peso', 'fecha_entrega', 'created_at', 'updated_at']
        ]);
    }
}
