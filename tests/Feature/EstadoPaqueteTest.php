<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\EstadoPaquete;

class EstadoPaqueteTest extends TestCase
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
        EstadoPaquete::firstOrCreate(['estado' => 'En camino']);
    }

    /** @test */
    public function lista_estados_paquetes()
    {
        $response = $this->getJson('/api/estados-paquetes', $this->headers);
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'estado', 'created_at', 'updated_at']]]);
    }

    /** @test */
    public function crea_estado_paquete()
    {
        $data = ['estado' => 'Entregado'];
        $response = $this->postJson('/api/estados-paquetes', $data, $this->headers);
        $response->assertStatus(201)->assertJsonFragment(['estado' => 'Entregado']);
    }
}
