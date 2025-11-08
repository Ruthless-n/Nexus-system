<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\GrupoEconomico;
use App\Models\Bandeira;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GrupoEconomicoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_grupo_economico()
    {
        $grupoEconomico = GrupoEconomico::factory()->create([
            'nome' => 'Grupo Teste'
        ]);

        $this->assertDatabaseHas('grupos_economicos', [
            'nome' => 'Grupo Teste'
        ]);
    }

    /** @test */
    public function it_has_many_bandeiras()
    {
        $grupoEconomico = GrupoEconomico::factory()->create();
        $bandeira = Bandeira::factory()->create(['grupo_economico_id' => $grupoEconomico->id]);

        $this->assertTrue($grupoEconomico->bandeiras->contains($bandeira));
        $this->assertInstanceOf(Bandeira::class, $grupoEconomico->bandeiras->first());
    }

    /** @test */
    public function it_validates_unique_cnpj()
    {
        $grupoEconomico = GrupoEconomico::factory()->create([
            'cnpj' => '12345678901234'
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        GrupoEconomico::factory()->create([
            'cnpj' => '12345678901234'
        ]);
    }
}