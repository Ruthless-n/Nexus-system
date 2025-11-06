<?php

namespace Database\Factories;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Database\Eloquent\Factories\Factory;

class BandeiraFactory extends Factory
{
    protected $model = Bandeira::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->company,
            'grupo_economico_id' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
