<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
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
    }

    /** @test */
    public function logout()
    {
        $response = $this->postJson('/api/logout', [], $this->headers);
        $response->assertStatus(200)->assertJson(['message' => 'Sesión cerrada correctamente']);
    }
}
