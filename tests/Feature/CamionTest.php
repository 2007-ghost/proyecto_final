<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Camion;

class CamionTest extends TestCase
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

        Camion::factory()->count(2)->create();
    }

    /** @test */
    public function lista_camiones()
    {
        $response = $this->getJson('/api/camiones', $this->headers);
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'placa', 'modelo', 'created_at', 'updated_at']]]);
    }

    /** @test */
    public function crea_camion()
    {
        $data = [
            'placa' => 'XYZ123',
            'modelo' => '2020',
        ];

        $response = $this->postJson('/api/camiones', $data, $this->headers);
        $response->assertStatus(201)->assertJsonFragment(['placa' => 'XYZ123']);
    }

    /** @test */
    public function actualiza_camion()
    {
        $camion = Camion::first();
        $data = ['modelo' => '2025', 'placa' => 'XYZ432',];
        $response = $this->putJson("/api/camiones/{$camion->id}", $data, $this->headers);
        $response->assertStatus(200)->assertJsonFragment(['modelo' => '2025']);
    }

    /** @test */
    public function elimina_camion()
    {
        $camion = Camion::first();
        $response = $this->deleteJson("/api/camiones/{$camion->id}", [], $this->headers);
        $response->assertStatus(200)->assertJson(['message' => 'Camión eliminado']);
    }
}
