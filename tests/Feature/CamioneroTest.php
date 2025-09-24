<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Camionero;
use Carbon\Carbon;

class CamioneroTest extends TestCase
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

        Camionero::factory()->count(2)->create();
    }

    /** @test */
    public function lista_camioneros()
    {
        $response = $this->getJson('/api/camioneros', $this->headers);
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'nombre', 'apellido', 'documento', 'telefono', 'fecha_nacimiento', 'licencia', 'created_at', 'updated_at']]]);
    }

    /** @test */
    public function crea_camionero()
    {
        $data = [
            'nombre' => 'Pedro',
            'apellido' => 'Gomez',
            'documento' => '12345678',
            'telefono' => '3001234567',
            'fecha_nacimiento' => '1990-01-01',
            'licencia' => 'A1234567'
        ];

        $response = $this->postJson('/api/camioneros', $data, $this->headers);
        $response->assertStatus(201)->assertJsonFragment(['nombre' => 'Pedro']);
    }

    /** @test */
    public function actualiza_camionero()
    {
        $camionero = Camionero::first();

        $data = [
            'nombre' => 'Juanito',
            'apellido' => $camionero->apellido,
            'documento' => $camionero->documento,
            'telefono' => $camionero->telefono,
            'fecha_nacimiento' => Carbon::parse($camionero->fecha_nacimiento)->toDateString(),
            'licencia' => $camionero->licencia,
        ];

        $response = $this->putJson("/api/camioneros/{$camionero->id}", $data, $this->headers);
        $response->assertStatus(200)->assertJsonFragment(['nombre' => 'Juanito']);
    }

    /** @test */
    public function elimina_camionero()
    {
        $camionero = Camionero::first();
        $response = $this->deleteJson("/api/camioneros/{$camionero->id}", [], $this->headers);
        $response->assertStatus(200)->assertJson(['message' => 'Camionero eliminado correctamente']);
    }
}
