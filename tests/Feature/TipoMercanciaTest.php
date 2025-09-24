<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\TipoMercancia;

class TipoMercanciaTest extends TestCase
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

        TipoMercancia::factory()->count(2)->create();
    }

    /** @test */
    public function lista_tipos_mercancia()
    {
        $response = $this->getJson('/api/tipos-mercancia', $this->headers);
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'tipo', 'created_at', 'updated_at']]]);
    }

    /** @test */
    public function crea_tipo_mercancia()
    {
        $data = ['tipo' => 'Electrónica'];
        $response = $this->postJson('/api/tipos-mercancia', $data, $this->headers);
        $response->assertStatus(201)->assertJsonFragment(['tipo' => 'Electrónica']);
    }
}
