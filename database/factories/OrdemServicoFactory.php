<?php

namespace Database\Factories;

use App\Models\OrdemServico;
use App\Models\Usuario;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<OrdemServico>
 */
class OrdemServicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id' => Usuario::all()->random()->id,
            'funcionario_id' => Funcionario::all()->random()->id,
            'data_abertura' => Carbon::now(),
            'data_fechamento' => Carbon::now()->addDays($this->faker->numberBetween(1, 5)),
            'status' => $this->faker->randomElement(['aberta', 'fechada']),
            'valor_total' => $this->faker->numberBetween(1, 5000),
        ];

    }
}
