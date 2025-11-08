<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Unidade;
use App\Models\Bandeira;
use App\Models\Colaborador;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnidadeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_unidade()
    {
        $grupoEconomico = GrupoEconomico::factory()->create();
        $bandeira = Bandeira::factory()->create(['grupo_economico_id' => $grupoEconomico->id]);
        
        $unidade = Unidade::factory()->create([
            'nome_fantasia' => 'Unidade Teste',
            'razao_social' => 'Unidade Teste LTDA',
            'cnpj' => '12345678901234',
            'bandeira_id' => $bandeira->id
        ]);

        $this->assertDatabaseHas('unidades', [
            'nome_fantasia' => 'Unidade Teste',
            'razao_social' => 'Unidade Teste LTDA',
            'cnpj' => '12345678901234',
            'bandeira_id' => $bandeira->id
        ]);
    }

    /** @test */
    public function it_belongs_to_bandeira()
    {
        $bandeira = Bandeira::factory()->create();
        $unidade = Unidade::factory()->create(['bandeira_id' => $bandeira->id]);

        $this->assertInstanceOf(Bandeira::class, $unidade->bandeira);
        $this->assertEquals($bandeira->id, $unidade->bandeira->id);
    }

    /** @test */
    public function it_has_many_colaboradores()
    {
        $unidade = Unidade::factory()->create();
        $colaborador = Colaborador::factory()->create(['unidade_id' => $unidade->id]);

        $this->assertTrue($unidade->colaboradores->contains($colaborador));
        $this->assertInstanceOf(Colaborador::class, $unidade->colaboradores->first());
    }

    /** @test */
    public function it_validates_unique_cnpj()
    {
        $unidade = Unidade::factory()->create([
            'cnpj' => '12345678901234'
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        Unidade::factory()->create([
            'cnpj' => '12345678901234'
        ]);
    }
}