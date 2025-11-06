<?php

namespace Database\Factories;

use App\Models\Unidade;
use App\Models\Bandeira;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadeFactory extends Factory
{
    protected $model = Unidade::class;

    public function definition(): array
    {
        return [
            'nome_fantasia' => $this->faker->company,
            'razao_social' => $this->faker->company . ' Ltda',
            'cnpj' => $this->faker->numerify('########0001##'),
            'bandeira_id' => Bandeira::factory(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
