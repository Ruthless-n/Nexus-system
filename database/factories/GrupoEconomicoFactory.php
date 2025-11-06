<?php

namespace Database\Factories;

use App\Models\GrupoEconomico;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoEconomicoFactory extends Factory
{
    protected $model = GrupoEconomico::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->company,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
