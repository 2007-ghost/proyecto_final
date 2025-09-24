<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Camionero;
use App\Models\EstadoPaquete;
use App\Models\TipoMercancia;
use App\Models\Paquete;
use App\Models\DetallePaquete;
use Carbon\Carbon;

class DetallePaqueteTest extends TestCase
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

        EstadoPaquete::firstOrCreate(['estado' => 'Pendiente']);
        Camionero::factory()->count(2)->create();
        TipoMercancia::factory()->count(2)->create();
    }

    /** @test */
    public function lista_detalles_paquetes()
    {
        $detalle = DetallePaquete::factory()->create();
        $response = $this->getJson('/api/detalles-paquetes', $this->headers);
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'paquete_id', 'tipo_mercancia_id', 'dimension', 'peso', 'fecha_entrega', 'created_at', 'updated_at']]]);
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
            'dimension' => '10.5',
            'peso' => '5.2',
            'fecha_entrega' => Carbon::now()->addDays(15)->toDateString(),
        ];

        $response = $this->postJson('/api/detalles-paquetes', $data, $this->headers);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['id', 'paquete_id', 'tipo_mercancia_id', 'dimension', 'peso', 'fecha_entrega', 'created_at', 'updated_at']
            ]);
    }

    /** @test */
    public function actualiza_detalle_paquete()
    {
        $detalle = DetallePaquete::factory()->create();

        $data = [
            'paquete_id' => $detalle->paquete->id,
            'tipo_mercancia_id' => $detalle->tipoMercancia->id,
            'dimension' => 12.0,  // numeric
            'peso' => 6.0,        // numeric
            'fecha_entrega' => now()->addDays(20)->toDateString(),
        ];

        $response = $this->putJson("/api/detalles-paquetes/{$detalle->id}", $data, $this->headers);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'dimension' => 12.0,
                'peso' => 6.0,
            ]);
    }

    /** @test */
    public function elimina_detalle_paquete()
    {
        $detalle = DetallePaquete::factory()->create();
        $response = $this->deleteJson("/api/detalles-paquetes/{$detalle->id}", [], $this->headers);
        $response->assertStatus(200)
            ->assertJson(['message' => 'Detalle de paquete eliminado']);
    }
}
