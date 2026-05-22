<?php

namespace Database\Factories;

use App\Models\OrdemServico;
use App\Models\Usuario;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'data_abertura' => now(),
            'data_fechamento' => now()->addDays($this->faker->numberBetween(1, 5)),
            'status' => $this->faker->randomElement(['Aberto', 'Fechado']),
            'valor_total' => $this->faker->numberBetween(1, 5000),
        ];

    }
}
