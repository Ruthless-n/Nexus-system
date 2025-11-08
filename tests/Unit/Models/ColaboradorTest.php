<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ColaboradorTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_create_colaborador()
    {
        $grupoEconomico = GrupoEconomico::factory()->create();
        $bandeira = Bandeira::factory()->create(['grupo_economico_id' => $grupoEconomico->id]);
        $unidade = Unidade::factory()->create(['bandeira_id' => $bandeira->id]);
        
        $colaborador = Colaborador::factory()->create([
            'nome' => 'João Silva',
            'email' => 'joao@exemplo.com',
            'cpf' => '12345678901',
            'unidade_id' => $unidade->id
        ]);

        $this->assertDatabaseHas('colaboradores', [
            'nome' => 'João Silva',
            'email' => 'joao@exemplo.com',
            'cpf' => '12345678901',
            'unidade_id' => $unidade->id
        ]);
    }

    public function it_belongs_to_unidade()
    {
        $unidade = Unidade::factory()->create();
        $colaborador = Colaborador::factory()->create(['unidade_id' => $unidade->id]);

        $this->assertInstanceOf(Unidade::class, $colaborador->unidade);
        $this->assertEquals($unidade->id, $colaborador->unidade->id);
    }

    public function it_validates_unique_email()
    {
        $colaborador = Colaborador::factory()->create([
            'email' => 'teste@exemplo.com'
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        Colaborador::factory()->create([
            'email' => 'teste@exemplo.com'
        ]);
    }

    public function it_validates_unique_cpf()
    {
        $colaborador = Colaborador::factory()->create([
            'cpf' => '12345678901'
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        Colaborador::factory()->create([
            'cpf' => '12345678901'
        ]);
    }
}