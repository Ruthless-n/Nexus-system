<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Bandeira;
use App\Models\Unidade;
use App\Models\GrupoEconomico;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BandeiraTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_bandeira()
    {
        $grupoEconomico = GrupoEconomico::factory()->create();
        
        $bandeira = Bandeira::factory()->create([
            'nome' => 'Bandeira Teste',
            'grupo_economico_id' => $grupoEconomico->id
        ]);

        $this->assertDatabaseHas('bandeiras', [
            'nome' => 'Bandeira Teste',
            'grupo_economico_id' => $grupoEconomico->id
        ]);
    }

    /** @test */
    public function it_belongs_to_grupo_economico()
    {
        $grupoEconomico = GrupoEconomico::factory()->create();
        $bandeira = Bandeira::factory()->create(['grupo_economico_id' => $grupoEconomico->id]);

        $this->assertInstanceOf(GrupoEconomico::class, $bandeira->grupoEconomico);
        $this->assertEquals($grupoEconomico->id, $bandeira->grupoEconomico->id);
    }

    /** @test */
    public function it_has_many_unidades()
    {
        $grupoEconomico = GrupoEconomico::factory()->create();
        $bandeira = Bandeira::factory()->create(['grupo_economico_id' => $grupoEconomico->id]);
        $unidade = Unidade::factory()->create(['bandeira_id' => $bandeira->id]);

        $this->assertTrue($bandeira->unidades->contains($unidade));
        $this->assertInstanceOf(Unidade::class, $bandeira->unidades->first());
    }
}