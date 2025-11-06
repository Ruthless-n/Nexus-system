<?php

namespace Database\Factories;

use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ColaboradorFactory extends Factory
{
    protected $model = Colaborador::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'unidade_id' => Unidade::factory(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
