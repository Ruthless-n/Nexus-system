<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Unidade;
use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ColaboradorApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_colaborador()
    {
        // Criando dependências
        $user = User::factory()->create();

        $grupo = GrupoEconomico::factory()->create();
        $bandeira = Bandeira::factory()->create([
            'grupo_economico_id' => $grupo->id,
        ]);

        $unidade = Unidade::factory()->create([
            'bandeira_id' => $bandeira->id,
        ]);

        $payload = [
            'nome' => 'Maria Souza',
            'email' => 'maria@example.com',
            'cpf' => '987.654.321-00',
            'unidade_id' => $unidade->id,
        ];

        $response = $this->actingAs($user, 'sanctum')
                         ->postJson('/api/colaboradores', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['nome' => 'Maria Souza']);
    }

    public function test_guest_cannot_create_colaborador()
    {
        $grupo = GrupoEconomico::factory()->create();
        $bandeira = Bandeira::factory()->create([
            'grupo_economico_id' => $grupo->id,
        ]);
        $unidade = Unidade::factory()->create([
            'bandeira_id' => $bandeira->id,
        ]);

        $payload = [
            'nome' => 'Maria Souza',
            'email' => 'maria@example.com',
            'cpf' => '987.654.321-00',
            'unidade_id' => $unidade->id,
        ];

        $response = $this->postJson('/api/colaboradores', $payload);

        $response->assertStatus(401);
    }
}
