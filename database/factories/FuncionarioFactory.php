<?php

namespace Database\Factories;

use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;

/**
 * @extends Factory<Funcionario>
 */
class FuncionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id' => (Usuario::all()->random())->id,
            'nome_cargo' => $this->faker->randomElement(['mecânico', 'contador', 'gerente', 'atendente', 'almoxarife']),
            'salario' => $this->faker->randomFloat(2, 1000, 10000),
            'nivel_permissao' => $this->faker->numberBetween(1, 5),
        ];
    }
}
