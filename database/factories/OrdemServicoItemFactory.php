<?php

namespace Database\Factories;


use App\Models\OrdemServicoItens;
use App\Models\Usuario;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrdemServicoItens>
 */
class OrdemServicoItensFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            $status = rand(0, 1) ? 'Aberto' : 'Fechado';
            $dataabertura = now()

            return [
            'usuario_id' => Usuario::all()->random()->id,
            'funcionario_id' => Funcionario::all()->random()->id,
            'data_abertura' => $this->now(),
            'data_fechamento' => $this->faker->numberBetween(1, 5),
            'status' => $this->$status,
            'valor_total' => $this->faker->numberBetween(1, 5000),
        ];
    }
}
