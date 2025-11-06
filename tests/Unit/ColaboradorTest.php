<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Colaborador;
use App\Models\Unidade;
use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ColaboradorTest extends TestCase
{
    use RefreshDatabase;

    public function test_colaborador_creation_sets_auditoria()
    {
        $user = User::factory()->create();

        $grupo = GrupoEconomico::factory()->create();
        $bandeira = Bandeira::factory()->create([
            'grupo_economico_id' => $grupo->id,
        ]);

        $unidade = Unidade::factory()->create([
            'bandeira_id' => $bandeira->id,
        ]);

        $colaborador = Colaborador::create([
            'nome' => 'João da Silva',
            'cpf' => '123.456.789-10',
            'email' => 'joao@example.com',
            'unidade_id' => $unidade->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $this->assertEquals($user->id, $colaborador->created_by);
        $this->assertEquals($user->id, $colaborador->updated_by);
    }
}
