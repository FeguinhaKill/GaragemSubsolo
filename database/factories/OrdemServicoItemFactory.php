<?php

namespace Database\Factories;


use App\Models\OrdemServicoitem;
use App\Models\OrdemServico;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrdemServicoitem>
 */
class OrdemServicoitemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
            'ordem_servico_id' => OrdemServico::all()->random()->id,
            'produto_id' => Produto::all()->random()->id,
            'quantidade' => $this->faker->numberBetween(1, 10),
            'tipo_servico' => $this->faker->randomElement(['Reparo', 'Manutenção']),
            'valor_total' => $this->faker->numberBetween(1, 5000),
        ];
    }
}
